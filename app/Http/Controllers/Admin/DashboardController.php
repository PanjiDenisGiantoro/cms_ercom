<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerApplication;
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

        $stats['portfolio_draft'] = $stats['portfolio'] - $stats['portfolio_published'];
        $stats['publish_rate'] = $stats['portfolio'] > 0
            ? (int) round($stats['portfolio_published'] / $stats['portfolio'] * 100)
            : 0;

        $recentPortfolio = Portfolio::with('category')
            ->latest()
            ->take(5)
            ->get();

        $content = [
            ['label' => 'Portfolio', 'count' => $stats['portfolio']],
            ['label' => 'Layanan', 'count' => $stats['services']],
            ['label' => 'Testimoni', 'count' => $stats['testimonials']],
            ['label' => 'Partner', 'count' => $stats['partners']],
            ['label' => 'Tim', 'count' => $stats['team']],
            ['label' => 'Stats', 'count' => $stats['stats']],
        ];

        $maxCount = max(array_column($content, 'count'));
        foreach ($content as &$item) {
            $item['height'] = $maxCount > 0 ? max(10, (int) round($item['count'] / $maxCount * 76)) : 6;
            $item['active'] = $maxCount > 0 && $item['count'] === $maxCount;
        }
        unset($item);

        $totalContent = array_sum(array_column($content, 'count'));

        $teamMembers = Team::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();

        $users = User::take(3)->get();

        $stats['careers'] = Career::where('is_active', true)->count();
        $stats['applications'] = CareerApplication::count();

        $careers = Career::where('is_active', true)
            ->withCount('applications')
            ->orderBy('order')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentPortfolio',
            'content',
            'totalContent',
            'teamMembers',
            'users',
            'careers'
        ));
    }
}
