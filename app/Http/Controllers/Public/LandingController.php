<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Pme;
use App\Models\Training;

class LandingController extends Controller
{
    public function __invoke()
    {
        return view('public.landing', [
            'stats' => [
                'pmes' => Pme::where('status', Pme::STATUS_ACTIVE)->count(),
                'opportunities' => Opportunity::published()->count(),
                'trainings' => Training::published()->count(),
                'categories' => BusinessCategory::where('is_active', true)->count(),
            ],
            'latestOpportunities' => Opportunity::published()
                ->with('categories')
                ->latest('published_at')
                ->limit(3)
                ->get(),
            'latestNews' => News::published()->latest('published_at')->limit(2)->get(),
            'categories' => BusinessCategory::where('is_active', true)
                ->withCount(['pmes as pmes_count' => fn ($q) => $q->where('pmes.status', Pme::STATUS_ACTIVE)])
                ->orderBy('name')
                ->get(),
        ]);
    }
}
