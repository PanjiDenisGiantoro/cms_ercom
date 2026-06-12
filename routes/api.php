<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/sections/navbar', [Api\SectionController::class, 'navbar']);
    Route::get('/sections/hero', [Api\SectionController::class, 'hero']);
    Route::get('/sections/stats', [Api\SectionController::class, 'stats']);
    Route::get('/sections/about', [Api\SectionController::class, 'about']);
    Route::get('/sections/services', [Api\SectionController::class, 'services']);
    Route::get('/sections/cta-banner', [Api\SectionController::class, 'ctaBanner']);
    Route::get('/sections/testimonials', [Api\SectionController::class, 'testimonials']);
    Route::get('/sections/partners', [Api\SectionController::class, 'partners']);
    Route::get('/sections/team', [Api\SectionController::class, 'team']);
    Route::get('/sections/footer', [Api\SectionController::class, 'footer']);
    Route::get('/sections/seo', [Api\SectionController::class, 'seo']);

    Route::get('/portfolio', [Api\PortfolioController::class, 'index']);
    Route::get('/portfolio/{slug}', [Api\PortfolioController::class, 'show']);

    Route::get('/careers', [Api\CareerController::class, 'index']);
    Route::get('/careers/{slug}', [Api\CareerController::class, 'show']);
    Route::post('/careers/{slug}/apply', [Api\CareerController::class, 'apply']);
});
