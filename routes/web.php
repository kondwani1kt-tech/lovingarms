<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubmissionController;
use App\Http\Middleware\EnsureRole;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/services/{service}', 'service')->name('services.show')->where('service', '[a-z0-9-]+');
    Route::get('/how-it-works', 'howItWorks')->name('how-it-works');
    Route::get('/care-standards', 'careStandards')->name('care-standards');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/payment', 'payment')->name('payment');
    Route::get('/resources', 'resources')->name('resources');
    Route::get('/reviews', 'reviews')->name('reviews');
    Route::get('/areas/{area}', 'area')->name('areas.show')->where('area', '[a-z0-9-]+');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/staffing', 'staffing')->name('staffing');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/privacy-practices', 'privacyPractices')->name('privacy-practices');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/accessibility', 'accessibility')->name('accessibility');
});

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::post('/analytics', [AnalyticsController::class, 'store'])->middleware('throttle:60,1')->name('analytics.store');

Route::middleware('throttle:6,1')->controller(SubmissionController::class)->group(function () {
    Route::post('/contact', 'inquiry')->name('inquiry.store');
    Route::post('/careers/apply', 'application')->name('application.store');
    Route::post('/staffing/request', 'staffing')->name('staffing.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'show'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'login'])->middleware('throttle:6,1');
    });

    Route::middleware(['auth', EnsureRole::class.':admin,staff'])->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');

        Route::prefix('records/{type}')->where(['type' => 'inquiries|applications|staffing', 'id' => '[0-9]+'])
            ->name('records.')->controller(Admin\RecordController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('{id}', 'show')->name('show');
                Route::patch('{id}/status', 'status')->name('status');
                Route::post('{id}/notes', 'note')->name('note');
                Route::delete('{id}', 'destroy')->name('destroy');
            });
        Route::post('records/applications/{id}/roster', [Admin\RecordController::class, 'roster'])->whereNumber('id')->name('records.roster');

        Route::prefix('{resource}')->where(['resource' => 'clients|caregivers', 'id' => '[0-9]+'])
            ->name('resource.')->controller(Admin\ResourceController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::put('{id}', 'update')->name('update');
                Route::delete('{id}', 'destroy')->name('destroy');
            });

        Route::get('schedule', [Admin\ShiftController::class, 'calendar'])->name('shifts.calendar');
        Route::resource('shifts', Admin\ShiftController::class)->except('show');

        Route::get('reports', [Admin\ReportController::class, 'index'])->name('reports');
        Route::post('reports/email', [Admin\ReportController::class, 'email'])->name('reports.email');

        Route::middleware(EnsureRole::class.':admin')->prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [Admin\StaffController::class, 'index'])->name('index');
            Route::get('create', [Admin\StaffController::class, 'create'])->name('create');
            Route::post('/', [Admin\StaffController::class, 'store'])->name('store');
            Route::get('{user}/edit', [Admin\StaffController::class, 'edit'])->name('edit');
            Route::put('{user}', [Admin\StaffController::class, 'update'])->name('update');
            Route::delete('{user}', [Admin\StaffController::class, 'destroy'])->name('destroy');
        });
    });
});
