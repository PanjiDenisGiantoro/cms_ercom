<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Landing — semua data sekaligus untuk halaman utama
    |--------------------------------------------------------------------------
    */
    Route::get('/landing', [Api\LandingController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Sections — settings per-section (single resource)
    |--------------------------------------------------------------------------
    */
    Route::prefix('sections')->group(function () {
        Route::get('/navbar', [Api\SectionController::class, 'navbar']);
        Route::get('/hero/{type?}', [Api\SectionController::class, 'hero']);
        Route::get('/about', [Api\SectionController::class, 'about']);
        Route::get('/cta-banner', [Api\SectionController::class, 'ctaBanner']);
        Route::get('/footer', [Api\SectionController::class, 'footer']);
        Route::get('/seo', [Api\SectionController::class, 'seo']);
        Route::get('/stats', [Api\SectionController::class, 'stats']);
        Route::get('/services', [Api\SectionController::class, 'services']);
        Route::get('/testimonials', [Api\SectionController::class, 'testimonials']);
        Route::get('/partners', [Api\SectionController::class, 'partners']);
        Route::get('/team', [Api\SectionController::class, 'team']);
    });

    /*
    |--------------------------------------------------------------------------
    | About — Section 2 (repeatable highlight items)
    |--------------------------------------------------------------------------
    */
    Route::get('/about-sections', [Api\AboutSectionController::class, 'index']);
    Route::get('/about-sections/{id}', [Api\AboutSectionController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | About — Section 3 (settings + milestones)
    |--------------------------------------------------------------------------
    */
    Route::get('/about-milestones', [Api\AboutMilestoneController::class, 'index']);
    Route::get('/about-milestones/{id}', [Api\AboutMilestoneController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | About — Section 4 (items + pages)
    |--------------------------------------------------------------------------
    */
    Route::get('/about-section4-items', [Api\AboutSection4ItemController::class, 'index']);
    Route::get('/about-section4-items/{id}', [Api\AboutSection4ItemController::class, 'show']);
    Route::get('/about-section4-pages', [Api\AboutSection4PageController::class, 'index']);
    Route::get('/about-section4-pages/{id}', [Api\AboutSection4PageController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Portfolio
    |--------------------------------------------------------------------------
    */
    Route::get('/portfolio', [Api\PortfolioController::class, 'index']);
    Route::get('/portfolio/{slug}', [Api\PortfolioController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Careers
    |--------------------------------------------------------------------------
    */
    Route::get('/careers', [Api\CareerController::class, 'index']);
    Route::get('/careers/{slug}', [Api\CareerController::class, 'show']);
    Route::post('/careers/{slug}/apply', [Api\CareerController::class, 'apply']);

    /*
    |--------------------------------------------------------------------------
    | Testimonials
    |--------------------------------------------------------------------------
    */
    Route::get('/testimonials', [Api\TestimonialController::class, 'index']);
    Route::get('/testimonials/{id}', [Api\TestimonialController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Partners
    |--------------------------------------------------------------------------
    */
    Route::get('/partners', [Api\PartnerController::class, 'index']);
    Route::get('/partners/{id}', [Api\PartnerController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Team
    |--------------------------------------------------------------------------
    */
    Route::get('/team', [Api\TeamController::class, 'index']);
    Route::get('/team/{id}', [Api\TeamController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Stats
    |--------------------------------------------------------------------------
    */
    Route::get('/stats', [Api\StatController::class, 'index']);
    Route::get('/stats/{id}', [Api\StatController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Services (kategori + items + sub-items)
    |--------------------------------------------------------------------------
    */
    Route::get('/services', [Api\ServiceController::class, 'index']);
    Route::get('/services/{slug}', [Api\ServiceController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | Blog
    |--------------------------------------------------------------------------
    */
    Route::get('/blog', [Api\BlogController::class, 'index']);
    Route::get('/blog/{slug}', [Api\BlogController::class, 'show']);
    Route::get('/blog-categories', [Api\BlogCategoryController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Client
    |--------------------------------------------------------------------------
    */
    Route::get('/clients', [Api\ClientController::class, 'index']);
    Route::get('/clients/{id}', [Api\ClientController::class, 'show']);
    Route::get('/client-categories', [Api\ClientCategoryController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    */
    Route::get('/contacts', [Api\ContactController::class, 'index']);
    Route::get('/contacts/{id}', [Api\ContactController::class, 'show']);
    Route::post('/contact-messages', [Api\ContactMessageController::class, 'store']);

    /*
    |--------------------------------------------------------------------------
    | Protected — data pribadi (pelamar karir & pesan kontak), butuh token Sanctum
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/career-applications', [Api\CareerApplicationController::class, 'index']);
        Route::get('/career-applications/{career_application}', [Api\CareerApplicationController::class, 'show']);
        Route::get('/contact-messages', [Api\ContactMessageController::class, 'index']);
        Route::get('/contact-messages/{contact_message}', [Api\ContactMessageController::class, 'show']);
    });

});
