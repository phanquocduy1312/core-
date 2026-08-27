<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

// 1. Home Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home', [PageController::class, 'home'])->name('client.home');

// 2. Product Catalog Routes (With & Without Prefix)
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/tam-pin-mat-troi', [ProductController::class, 'solarPanel'])->name('products.solar-panel');
Route::get('/san-pham/inverter', [ProductController::class, 'inverter'])->name('products.inverter');
Route::get('/san-pham/pin-luu-tru', [ProductController::class, 'battery'])->name('products.battery');
Route::get('/san-pham/bien-tan-bom', [ProductController::class, 'pump'])->name('products.pump');
Route::get('/san-pham/phu-kien-solar', [ProductController::class, 'accessories'])->name('products.accessories');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

// Direct category aliases
Route::get('/tam-pin-mat-troi', [ProductController::class, 'solarPanel'])->name('solar-panel');
Route::get('/inverter', [ProductController::class, 'inverter'])->name('inverter');
Route::get('/pin-luu-tru', [ProductController::class, 'battery'])->name('battery');
Route::get('/bien-tan-bom', [ProductController::class, 'pump'])->name('pump');
Route::get('/phu-kien-solar', [ProductController::class, 'accessories'])->name('accessories');

// 3. Information Page Routes
Route::get('/gioi-thieu', [PageController::class, 'about'])->name('about');
Route::get('/thuong-hieu', [PageController::class, 'brands'])->name('brands');
Route::get('/du-an', [PageController::class, 'projects'])->name('projects');
Route::get('/ho-tro-ky-thuat', [PageController::class, 'technicalSupport'])->name('technical-support');
Route::get('/tin-tuc', [PageController::class, 'news'])->name('news');
Route::get('/lien-he', [PageController::class, 'contact'])->name('lien-he');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Admin Login & API Docs
Route::get('/login', fn () => redirect('/'.app(\App\Services\LanguageRegistry::class)->defaultLocale().'/admin/login'))->name('login');
Route::get('/api/docs', [\App\Http\Controllers\Api\PublicController::class, 'docs'])->name('api.docs');

// Customer Password Reset
Route::get('/customer/reset-password/{token}', [\App\Http\Controllers\Auth\CustomerResetPasswordController::class, 'create'])->name('customer.password.reset');
Route::post('/customer/reset-password', [\App\Http\Controllers\Auth\CustomerResetPasswordController::class, 'store'])
    ->middleware('throttle:public-auth')
    ->name('customer.password.update');

// Mock VNPAY gateway — for local/testing only. Never registered in production;
// the controller also guards each request (see assertVnpayMockEnabled).
if (config('app.payment_mock_enabled') && app()->environment(['local', 'testing'])) {
    Route::get('/payment/vnpay/mock', [\App\Http\Controllers\Api\PublicController::class, 'vnpayMockPayment'])->name('vnpay.mock');
    Route::post('/payment/vnpay/mock/submit', [\App\Http\Controllers\Api\PublicController::class, 'vnpayMockSubmit'])
        ->middleware('throttle:10,1')
        ->name('vnpay.mock.submit');
}

// 4. Legacy .html URL compatibility redirects
Route::get('/{slug}.html', function (\Illuminate\Http\Request $request, $slug) {
    $queryString = $request->getQueryString();
    $targetMap = [
        'thuong-hieu' => '/thuong-hieu',
        'san-pham' => '/san-pham',
        'ho-tro-ky-thuat' => '/ho-tro-ky-thuat',
        'gioi-thieu' => '/gioi-thieu',
        'du-an' => '/du-an',
        'tin-tuc' => '/tin-tuc',
        'lien-he' => '/lien-he',
    ];

    $path = $targetMap[$slug] ?? ('/' . $slug);
    $url = $path . ($queryString ? '?' . $queryString : '');
    return redirect($url);
});
