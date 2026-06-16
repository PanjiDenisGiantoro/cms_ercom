<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use App\Models\CtaBannerSetting;
use App\Models\FooterSetting;
use App\Models\HeroSetting;
use App\Models\NavbarSetting;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\SeoSetting;
use App\Models\ServiceSetting;
use App\Models\Stat;
use App\Models\Team;
use App\Models\TeamSetting;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class LandingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'navbar' => NavbarSetting::instance(),
            'hero' => HeroSetting::instance(),
            'about' => AboutSetting::instance(),
            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
            'testimonial' => Testimonial::where('is_active', true)->orderBy('order')->first(),
            'partners' => Partner::where('is_active', true)->orderBy('order')->get(),
            'team_setting' => TeamSetting::instance(),
            'team_members' => Team::where('is_active', true)->orderBy('order')->get(),
            'service_setting' => ServiceSetting::instance(),
            'portfolios' => Portfolio::with('category')
                ->where('is_published', true)
                ->latest()
                ->take(3)
                ->get(),
            'cta_banner' => CtaBannerSetting::instance(),
            'footer' => FooterSetting::instance(),
            'seo' => SeoSetting::instance(),
        ]);
    }
}
