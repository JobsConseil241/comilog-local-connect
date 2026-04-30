<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $pme = $request->user()->pme;
        $categoryIds = $pme ? $pme->categories()->pluck('business_categories.id')->all() : [];

        $opportunities = Opportunity::published()
            ->forCategories($categoryIds)
            ->with('categories')
            ->latest('published_at')
            ->limit(5)
            ->get();

        return view('pme.dashboard', [
            'pme' => $pme,
            'stats' => [
                'opportunities' => Opportunity::published()->forCategories($categoryIds)->count(),
                'trainings' => Training::published()->count(),
                'news' => News::published()->count(),
                'categories' => count($categoryIds),
            ],
            'opportunities' => $opportunities,
            'trainings' => Training::published()->orderBy('date_debut')->limit(3)->get(),
            'news' => News::published()->latest('published_at')->limit(3)->get(),
        ]);
    }
}
