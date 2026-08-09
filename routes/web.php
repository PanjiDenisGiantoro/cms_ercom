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

    Route::post('/filepond/process', [Admin\FilePondUploadController::class, 'store'])->name('filepond.process');
    Route::delete('/filepond/revert', [Admin\FilePondUploadController::class, 'revert'])->name('filepond.revert');

    Route::get('/navbar', [Admin\NavbarController::class, 'edit'])->name('navbar.edit');
    Route::put('/navbar', [Admin\NavbarController::class, 'update'])->name('navbar.update');

    Route::resource('hero', Admin\HeroController::class)->except('show');

    Route::resource('highlights', Admin\HighlightController::class)->except('show');
    Route::resource('contacts', Admin\ContactController::class)->except('show');

    Route::get('/contact-messages', [Admin\ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('/contact-messages/{contact_message}', [Admin\ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::resource('clients', Admin\ClientController::class)->except('show');
    Route::resource('client-categories', Admin\ClientCategoryController::class)->except('show');

    Route::get('/about', [Admin\AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [Admin\AboutController::class, 'update'])->name('about.update');

    Route::resource('about-sections', Admin\AboutSectionController::class)->except('show');

    Route::get('/about-section3', [Admin\AboutSection3Controller::class, 'edit'])->name('about-section3.edit');
    Route::put('/about-section3', [Admin\AboutSection3Controller::class, 'update'])->name('about-section3.update');
    Route::resource('about-milestones', Admin\AboutMilestoneController::class)->except('show');

    Route::resource('about-section4-items', Admin\AboutSection4ItemController::class)->except('show');
    Route::resource('about-section4-pages', Admin\AboutSection4PageController::class)->except('show');

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

    Route::get('/team-settings', [Admin\TeamSettingController::class, 'edit'])->name('team-settings.edit');
    Route::put('/team-settings', [Admin\TeamSettingController::class, 'update'])->name('team-settings.update');

    Route::get('/service-settings', [Admin\ServiceSettingController::class, 'edit'])->name('service-settings.edit');
    Route::put('/service-settings', [Admin\ServiceSettingController::class, 'update'])->name('service-settings.update');

    Route::resource('services', Admin\ServiceCategoryController::class)->except('show');
    Route::resource('services.items', Admin\ServiceItemController::class)->except('show');
    Route::patch('/services/{service}/items/{item}/toggle-selected', [Admin\ServiceItemController::class, 'toggleSelected'])->name('services.items.toggle-selected');
    Route::resource('services.items.sub-items', Admin\ServiceSubItemController::class)->except('show');

    Route::resource('portfolio', Admin\PortfolioController::class)->except('show');

    Route::resource('blog', Admin\BlogController::class)->except('show');
    Route::resource('blog-categories', Admin\BlogCategoryController::class)->except('show');

    Route::resource('careers', Admin\CareerController::class)->except('show');
    Route::resource('careers.applications', Admin\CareerApplicationController::class)->only(['index', 'destroy']);
    Route::get('/careers/{career}/applications/{application}/download', [Admin\CareerApplicationController::class, 'download'])->name('careers.applications.download');

    Route::get('/career-applicants', [Admin\CareerApplicantController::class, 'index'])->name('career-applicants.index');
    Route::get('/career-applicants/{career_applicant}', [Admin\CareerApplicantController::class, 'show'])->name('career-applicants.show');
    Route::get('/career-applicants/{career_applicant}/download', [Admin\CareerApplicantController::class, 'download'])->name('career-applicants.download');
    Route::delete('/career-applicants/{career_applicant}', [Admin\CareerApplicantController::class, 'destroy'])->name('career-applicants.destroy');

    Route::resource('users', Admin\UserController::class)->except('show');
});
