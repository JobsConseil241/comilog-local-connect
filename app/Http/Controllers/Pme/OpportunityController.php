<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\OpportunityInterest;
use App\Models\User;
use App\Notifications\PmeInterestExpressed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    public function index(Request $request): View
    {
        $pme = $request->user()->pme;
        $categoryIds = $pme ? $pme->categories()->pluck('business_categories.id')->all() : [];

        $opportunities = Opportunity::published()
            ->forCategories($categoryIds)
            ->with('categories')
            ->latest('published_at')
            ->paginate(12);

        return view('pme.opportunities.index', [
            'opportunities' => $opportunities,
            'pme' => $pme,
        ]);
    }

    public function show(Request $request, Opportunity $opportunity): View
    {
        abort_unless($opportunity->status === Opportunity::STATUS_PUBLISHED, 404);

        $pme = $request->user()->pme;
        $pmeCategoryIds = $pme ? $pme->categories()->pluck('business_categories.id')->all() : [];
        $oppCategoryIds = $opportunity->categories->pluck('id')->all();

        return view('pme.opportunities.show', [
            'opportunity' => $opportunity->load('categories'),
            'pme' => $pme,
            'matchesMetier' => (bool) array_intersect($pmeCategoryIds, $oppCategoryIds),
            'alreadyInterested' => $opportunity->isInterestedBy($pme),
        ]);
    }

    public function expressInterest(Request $request, Opportunity $opportunity): RedirectResponse
    {
        abort_unless($opportunity->status === Opportunity::STATUS_PUBLISHED, 404);

        $user = $request->user();
        $pme = $user->pme;
        abort_unless($pme, 403, 'Aucune PME associée à ce compte.');
        abort_unless($pme->isActive(), 403, 'Votre compte PME doit être activé pour manifester un intérêt.');

        $interest = OpportunityInterest::firstOrCreate(
            [
                'opportunity_id' => $opportunity->id,
                'pme_id' => $pme->id,
            ],
            [
                'user_id' => $user->id,
            ]
        );

        if ($interest->wasRecentlyCreated) {
            try {
                $admins = User::where('role', User::ROLE_ADMIN_COMILOG)->get();
                if ($admins->isNotEmpty()) {
                    Notification::send($admins, new PmeInterestExpressed($opportunity, $pme, $user));
                }
            } catch (\Throwable $e) {
                Log::warning('PmeInterestExpressed dispatch failed: ' . $e->getMessage());
            }

            return back()->with('success', "Votre intérêt sur « {$opportunity->titre} » a bien été transmis au service Achats COMILOG. Vous serez recontacté par les canaux habituels.");
        }

        return back()->with('success', "Vous aviez déjà manifesté votre intérêt sur cette opportunité.");
    }
}
