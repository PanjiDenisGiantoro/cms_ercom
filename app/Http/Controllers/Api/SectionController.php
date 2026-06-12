<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use App\Models\CtaBannerSetting;
use App\Models\FooterSetting;
use App\Models\HeroSetting;
use App\Models\NavbarSetting;
use App\Models\Partner;
use App\Models\SeoSetting;
use App\Models\ServiceCategory;
use App\Models\Stat;
use App\Models\Team;
use App\Models\TeamSetting;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class SectionController extends Controller
{
    public function navbar(): JsonResponse
    {
        return response()->json(NavbarSetting::instance());
    }

    public function hero(): JsonResponse
    {
        return response()->json(HeroSetting::instance());
    }

    public function stats(): JsonResponse
    {
        return response()->json(
            Stat::where('is_active', true)->orderBy('order')->get()
        );
    }

    public function about(): JsonResponse
    {
        return response()->json(AboutSetting::instance());
    }

    public function services(): JsonResponse
    {
        return response()->json(
            ServiceCategory::with(['items.subItems'])
                ->where('is_active', true)
                ->orderBy('order')
                ->get()
        );
    }

    public function ctaBanner(): JsonResponse
    {
        return response()->json(CtaBannerSetting::instance());
    }

    public function testimonials(): JsonResponse
    {
        return response()->json(
            Testimonial::where('is_active', true)->orderBy('order')->get()
        );
    }

    public function partners(): JsonResponse
    {
        return response()->json(
            Partner::where('is_active', true)->orderBy('order')->get()
        );
    }

    public function team(): JsonResponse
    {
        return response()->json([
            'settings' => TeamSetting::instance(),
            'members' => Team::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function footer(): JsonResponse
    {
        return response()->json(FooterSetting::instance());
    }

    public function seo(): JsonResponse
    {
        return response()->json(SeoSetting::instance());
    }
}
