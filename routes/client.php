<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/home', [PageController::class, 'home']);

Route::get('/san-pham', [ProductController::class, 'index']);
Route::get('/san-pham/tam-pin-mat-troi', [ProductController::class, 'solarPanel']);
Route::get('/san-pham/inverter', [ProductController::class, 'inverter']);
Route::get('/san-pham/pin-luu-tru', [ProductController::class, 'battery']);
Route::get('/san-pham/bien-tan-bom', [ProductController::class, 'pump']);
Route::get('/san-pham/phu-kien-solar', [ProductController::class, 'accessories']);
Route::get('/san-pham/{slug}', [ProductController::class, 'show']);

Route::get('/thuong-hieu', [PageController::class, 'brands']);
Route::get('/gioi-thieu', [PageController::class, 'about']);
Route::get('/tin-tuc', [PageController::class, 'news']);
Route::get('/lien-he', [PageController::class, 'contact']);
Route::get('/du-an', [PageController::class, 'projects']);
Route::get('/ho-tro-ky-thuat', [PageController::class, 'technicalSupport']);

Route::get('pages/{slug}', [\App\Http\Controllers\Client\PageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-_]+')
    ->name('pages.show');
