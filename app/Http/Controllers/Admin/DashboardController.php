<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Pme;
use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $now = now();
        $monthAgo = $now->copy()->subDays(30);

        $byCategory = DB::table('pme_business_category')
            ->join('business_categories', 'business_categories.id', '=', 'pme_business_category.business_category_id')
            ->select('business_categories.name', 'business_categories.color', DB::raw('COUNT(*) as total'))
            ->groupBy('business_categories.id', 'business_categories.name', 'business_categories.color')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('admin.dashboard', [
            'kpis' => [
                'pmes_total' => Pme::where('status', Pme::STATUS_ACTIVE)->count(),
                'pmes_pending' => Pme::where('status', Pme::STATUS_PENDING)->count(),
                'pmes_30d' => Pme::where('status', Pme::STATUS_ACTIVE)->where('created_at', '>=', $monthAgo)->count(),
                'opportunities_total' => Opportunity::where('status', Opportunity::STATUS_PUBLISHED)->count(),
                'opportunities_30d' => Opportunity::where('status', Opportunity::STATUS_PUBLISHED)->where('published_at', '>=', $monthAgo)->count(),
                'trainings_total' => Training::where('status', Training::STATUS_PUBLISHED)->count(),
                'news_total' => News::whereNotNull('published_at')->count(),
                'categories_total' => BusinessCategory::where('is_active', true)->count(),
                'active_users_30d' => User::where('role', User::ROLE_PME)->where('last_login_at', '>=', $monthAgo)->count(),
            ],
            'pmesByCategory' => $byCategory,
            'recentPmes' => Pme::with('categories')->latest()->limit(5)->get(),
            'recentOpportunities' => Opportunity::with('categories')->latest()->limit(5)->get(),
        ]);
    }
}
