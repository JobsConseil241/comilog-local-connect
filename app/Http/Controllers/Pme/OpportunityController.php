<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;
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

        abort_unless(array_intersect($pmeCategoryIds, $oppCategoryIds), 403, 'Cette opportunité ne concerne pas vos métiers.');

        return view('pme.opportunities.show', [
            'opportunity' => $opportunity->load('categories'),
        ]);
    }
}
