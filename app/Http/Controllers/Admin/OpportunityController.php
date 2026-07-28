<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\Opportunity;
use App\Models\Pme;
use App\Notifications\NewOpportunityDigest;
use App\Notifications\NewOpportunityPublished;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    public function index(Request $request): View
    {
        $query = Opportunity::with('categories', 'author')->latest();

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        return view('admin.opportunities.index', [
            'opportunities' => $query->paginate(20)->withQueryString(),
            'currentStatus' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.opportunities.form', [
            'opportunity' => new Opportunity(),
            'categories' => BusinessCategory::where('is_active', true)->orderBy('name')->get(),
            'selectedCategoryIds' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        $opportunity = Opportunity::create([
            ...collect($data)->except('categories')->all(),
            'reference' => $this->generateReference(),
            'created_by' => $request->user()->id,
            'published_at' => $data['status'] === Opportunity::STATUS_PUBLISHED ? now() : null,
        ]);

        $opportunity->categories()->sync($data['categories']);

        if ($opportunity->status === Opportunity::STATUS_PUBLISHED) {
            $this->notifyTargetedPmes($opportunity);
        }

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunité créée avec succès.');
    }

    public function edit(Opportunity $opportunity): View
    {
        return view('admin.opportunities.form', [
            'opportunity' => $opportunity,
            'categories' => BusinessCategory::where('is_active', true)->orderBy('name')->get(),
            'selectedCategoryIds' => $opportunity->categories->pluck('id')->all(),
        ]);
    }

    public function update(Request $request, Opportunity $opportunity): RedirectResponse
    {
        $data = $this->validateData($request);

        $previousStatus = $opportunity->status;
        $publishedAt = $opportunity->published_at;
        if ($data['status'] === Opportunity::STATUS_PUBLISHED && ! $publishedAt) {
            $publishedAt = now();
        }

        $opportunity->update([
            ...collect($data)->except('categories')->all(),
            'published_at' => $publishedAt,
        ]);

        $opportunity->categories()->sync($data['categories']);

        if ($previousStatus !== Opportunity::STATUS_PUBLISHED && $opportunity->status === Opportunity::STATUS_PUBLISHED) {
            $this->notifyTargetedPmes($opportunity);
        }

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunité mise à jour.');
    }

    public function destroy(Opportunity $opportunity): RedirectResponse
    {
        $opportunity->delete();

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunité supprimée.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:' . implode(',', array_keys(Opportunity::TYPES)),
            'deadline' => 'nullable|date|after_or_equal:today',
            'budget_estime' => 'nullable|string|max:255',
            'lieu_execution' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_nom' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,closed',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:business_categories,id',
        ]);
    }

    private function generateReference(): string
    {
        $year = now()->year;
        $count = Opportunity::whereYear('created_at', $year)->count() + 1;

        return 'COM-' . $year . '-' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * When an opportunity goes live, every active PME receives exactly one email:
     *   - NewOpportunityPublished (detailed) if at least one of their business
     *     categories matches the opportunity;
     *   - NewOpportunityDigest (broadcast) otherwise, as institutional visibility.
     *
     * Both notifications implement ShouldQueue.
     */
    private function notifyTargetedPmes(Opportunity $opportunity): void
    {
        try {
            $categoryIds = $opportunity->categories()->pluck('business_categories.id')->all();

            $matchingPmeIds = empty($categoryIds)
                ? []
                : Pme::query()
                    ->where('status', Pme::STATUS_ACTIVE)
                    ->whereHas('categories', fn ($q) => $q->whereIn('business_categories.id', $categoryIds))
                    ->pluck('id')
                    ->all();

            $activePmes = Pme::query()
                ->where('status', Pme::STATUS_ACTIVE)
                ->with('users')
                ->get();

            foreach ($activePmes as $pme) {
                $matches = in_array($pme->id, $matchingPmeIds, true);
                foreach ($pme->users as $user) {
                    if ($matches) {
                        $user->notify(new NewOpportunityPublished($opportunity, $pme));
                    } else {
                        $user->notify(new NewOpportunityDigest($opportunity, $pme));
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Opportunity dispatch failed: ' . $e->getMessage());
        }
    }
}
