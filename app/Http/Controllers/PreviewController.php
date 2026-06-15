<?php

namespace App\Http\Controllers;

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
use Illuminate\View\View;

class PreviewController extends Controller
{
    public function index(): View
    {
        return view('preview.index', [
            'navbar' => NavbarSetting::instance(),
            'hero' => HeroSetting::instance(),
            'about' => AboutSetting::instance(),
            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
            'testimonial' => Testimonial::where('is_active', true)->orderBy('order')->first(),
            'partners' => Partner::where('is_active', true)->orderBy('order')->get(),
            'teamSetting' => TeamSetting::instance(),
            'teamMembers' => Team::where('is_active', true)->orderBy('order')->get(),
            'serviceSetting' => ServiceSetting::instance(),
            'portfolios' => Portfolio::with('category')->where('is_published', true)->latest()->take(3)->get(),
            'ctaBanner' => CtaBannerSetting::instance(),
            'footer' => FooterSetting::instance(),
            'seo' => SeoSetting::instance(),
        ]);
    }
}