<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutMilestone;
use App\Models\AboutSection;
use App\Models\AboutSection3Setting;
use App\Models\AboutSection4Item;
use App\Models\AboutSection4Page;
use App\Models\AboutSetting;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Contact;
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
            'about_sections' => AboutSection::where('is_active', true)->orderBy('order')->get(),
            'about_section3_setting' => AboutSection3Setting::instance(),
            'about_milestones' => AboutMilestone::where('is_active', true)->orderBy('order')->get(),
            'about_section4_items' => AboutSection4Item::where('is_active', true)->orderBy('order')->get(),
            'about_section4_pages' => AboutSection4Page::where('is_active', true)->orderBy('order')->get(),
            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
            'testimonial' => Testimonial::where('is_active', true)->orderBy('order')->first(),
            'partners' => Partner::where('is_active', true)->orderBy('order')->get(),
            'team_setting' => HeroSetting::instance('team'),
            'team_members' => Team::where('is_active', true)->orderBy('order')->get(),
            'service_setting' => ServiceSetting::instance(),
            'portfolios' => Portfolio::with('category')
                ->where('is_published', true)
                ->latest()
                ->take(3)
                ->get(),
            'blogs' => Blog::with('category')
                ->where('is_published', true)
                ->latest('published_at')
                ->take(3)
                ->get(),
            'blog_categories' => BlogCategory::where('is_active', true)->orderBy('order')->get(),
            'clients' => Client::with('category')->where('is_active', true)->orderBy('order')->get(),
            'client_categories' => ClientCategory::where('is_active', true)->orderBy('order')->get(),
            'contacts' => Contact::where('is_active', true)->orderBy('order')->get(),
            'cta_banner' => CtaBannerSetting::instance(),
            'footer' => FooterSetting::instance(),
            'seo' => SeoSetting::instance(),
            'social' => [
                'whatsapp_number' => NavbarSetting::instance()->whatsapp_number,
                'social_media' => FooterSetting::instance()->social_media,
            ],
        ]);
    }
}
