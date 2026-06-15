<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/preview', [PreviewController::class, 'index'])->name('preview');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|editor'])->group(function () {

    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/navbar', [Admin\NavbarController::class, 'edit'])->name('navbar.edit');
    Route::put('/navbar', [Admin\NavbarController::class, 'update'])->name('navbar.update');

    Route::get('/hero', [Admin\HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [Admin\HeroController::class, 'update'])->name('hero.update');

    Route::get('/about', [Admin\AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [Admin\AboutController::class, 'update'])->name('about.update');

    Route::get('/cta-banner', [Admin\CtaBannerController::class, 'edit'])->name('cta-banner.edit');
    Route::put('/cta-banner', [Admin\CtaBannerController::class, 'update'])->name('cta-banner.update');

    Route::get('/footer', [Admin\FooterController::class, 'edit'])->name('footer.edit');
    Route::put('/footer', [Admin\FooterController::class, 'update'])->name('footer.update');

    Route::get('/seo', [Admin\SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo', [Admin\SeoController::class, 'update'])->name('seo.update');

    Route::resource('stats', Admin\StatsController::class)->except('show');
    Route::resource('testimonials', Admin\TestimonialController::class)->except('show');
    Route::resource('partners', Admin\PartnerController::class)->except('show');
    Route::resource('team', Admin\TeamController::class)->except('show');

    Route::get('/service-settings', [Admin\ServiceSettingController::class, 'edit'])->name('service-settings.edit');
    Route::put('/service-settings', [Admin\ServiceSettingController::class, 'update'])->name('service-settings.update');

    Route::resource('services', Admin\ServiceCategoryController::class)->except('show');
    Route::resource('services.items', Admin\ServiceItemController::class)->except('show');
    Route::resource('services.items.sub-items', Admin\ServiceSubItemController::class)->except('show');

    Route::resource('portfolio', Admin\PortfolioController::class)->except('show');

    Route::resource('careers', Admin\CareerController::class)->except('show');
    Route::resource('careers.applications', Admin\CareerApplicationController::class)->only(['index', 'destroy']);
    Route::get('/careers/{career}/applications/{application}/download', [Admin\CareerApplicationController::class, 'download'])->name('careers.applications.download');

    Route::resource('users', Admin\UserController::class)->except('show');
});
