<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

// 1. Home Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home', [PageController::class, 'home'])->name('client.home');

// 2. Information Page Routes (Both EN & VI Aliases)
Route::get('/gioi-thieu', [PageController::class, 'about'])->name('about');
Route::get('/about-luxlight', [PageController::class, 'about'])->name('about.en');

Route::get('/thuong-hieu', [PageController::class, 'brands'])->name('brands');
Route::get('/luxlight-lighting-brands', [PageController::class, 'brands'])->name('brands.en');

Route::get('/du-an', [PageController::class, 'projects'])->name('projects');
Route::get('/lighting-projects-in-asia', [PageController::class, 'projects'])->name('projects.en');
Route::get('/hospitality-lighting-projects', [PageController::class, 'hospitalityProjects'])->name('projects.hospitality');
Route::get('/residential-lighting-projects', [PageController::class, 'residentialProjects'])->name('projects.residential');
Route::get('/commercial-lighting-projects', [PageController::class, 'commercialProjects'])->name('projects.commercial');
Route::get('/other-lighting-projects', [PageController::class, 'otherProjects'])->name('projects.other');
Route::get('/projects', [PageController::class, 'projects'])->name('projects.list');
Route::get('/projects/{slug}', [PageController::class, 'projectDetail'])->name('projects.detail');

Route::post('/newsletter/subscribe', [PageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

Route::get('/lien-he', [PageController::class, 'contact'])->name('contact');
Route::get('/contact-luxlight', [PageController::class, 'contact'])->name('contact.en');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.alias');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-use', [PageController::class, 'termsOfUse'])->name('terms-of-use');
Route::get('/test-builder', fn () => redirect('/' . app(\App\Services\LanguageRegistry::class)->defaultLocale() . '/pages/test-builder'))->name('test-builder.redirect');

// 3. Product Catalog Routes (Preserved for core ecommerce compatibility)
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/tam-pin-mat-troi', [ProductController::class, 'solarPanel'])->name('products.solar-panel');
Route::get('/san-pham/inverter', [ProductController::class, 'inverter'])->name('products.inverter');
Route::get('/san-pham/pin-luu-tru', [ProductController::class, 'battery'])->name('products.battery');
Route::get('/san-pham/bien-tan-bom', [ProductController::class, 'pump'])->name('products.pump');
Route::get('/san-pham/phu-kien-solar', [ProductController::class, 'accessories'])->name('products.accessories');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

// 4. Admin Login & API Docs
Route::get('/login', fn () => redirect('/'.app(\App\Services\LanguageRegistry::class)->defaultLocale().'/admin/login'))->name('login');
Route::get('/api/docs', [\App\Http\Controllers\Api\PublicController::class, 'docs'])->name('api.docs');

// 5. Customer Password Reset
Route::get('/customer/reset-password/{token}', [\App\Http\Controllers\Auth\CustomerResetPasswordController::class, 'create'])->name('customer.password.reset');
Route::post('/customer/reset-password', [\App\Http\Controllers\Auth\CustomerResetPasswordController::class, 'store'])
    ->middleware('throttle:public-auth')
    ->name('customer.password.update');

// 6. Mock VNPAY gateway (Local/Testing only)
if (config('app.payment_mock_enabled') && ! app()->isProduction()) {
    Route::get('/payment/vnpay/mock', [\App\Http\Controllers\Api\PublicController::class, 'vnpayMockPayment'])->name('vnpay.mock');
    Route::post('/payment/vnpay/mock/submit', [\App\Http\Controllers\Api\PublicController::class, 'vnpayMockSubmit'])->name('vnpay.mock.submit');
}


