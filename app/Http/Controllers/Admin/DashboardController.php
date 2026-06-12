<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\ServiceCategory;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'portfolio' => Portfolio::count(),
            'portfolio_published' => Portfolio::where('is_published', true)->count(),
            'services' => ServiceCategory::count(),
            'testimonials' => Testimonial::count(),
            'partners' => Partner::count(),
            'team' => Team::count(),
            'stats' => Stat::count(),
            'users' => User::count(),
        ];

        $recentPortfolio = Portfolio::with('serviceCategory')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPortfolio'));
    }
}
