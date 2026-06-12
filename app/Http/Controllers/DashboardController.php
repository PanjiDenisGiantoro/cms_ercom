<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'visits' => 824,
            'popularity' => 87,
            'popularity_up' => 2,
            'monthly_income' => 12841,
            'general_rate' => 4.7,
            'members' => 12,
        ];

        $performers = [
            ['name' => 'Bessie Cooper', 'status' => 'Online',        'score' => 4.3, 'color' => 'from-amber-400 to-amber-600',   'initial' => 'B'],
            ['name' => 'Albert Flores', 'status' => 'Online',        'score' => 4.7, 'color' => 'from-violet-400 to-violet-700', 'initial' => 'A'],
            ['name' => 'Guy Hawkins',   'status' => '4 minutes ago', 'score' => 4.4, 'color' => 'from-emerald-400 to-emerald-600', 'initial' => 'G'],
        ];

        $finance = [
            ['month' => 'DEC', 'height' => 52, 'active' => false],
            ['month' => 'JAN', 'height' => 38, 'active' => false],
            ['month' => 'FEB', 'height' => 64, 'active' => true],
            ['month' => 'MAR', 'height' => 48, 'active' => false],
            ['month' => 'APR', 'height' => 70, 'active' => false],
            ['month' => 'MAY', 'height' => 56, 'active' => true],
        ];

        return view('dashboard.index', compact('stats', 'performers', 'finance'));
    }
}
