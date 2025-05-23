<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAdsController;
use App\Http\Controllers\CallsController;
use App\Http\Middleware\BasicAuthMiddleware;

Route::get('/', function () {
    return '<h1>API Mode Only</h1>';
});

Route::get('/test-middleware', function () {
    return '<h1>API Mode Only</h1>';
})->middleware(BasicAuthMiddleware::class);

Route::post('/test-post', [GoogleAdsController::class, 'testPost'])->middleware(BasicAuthMiddleware::class);

Route::get('/all-clicks', [GoogleAdsController::class, 'allClicks'])->middleware(BasicAuthMiddleware::class);

// Route to add Google Clicks
Route::post('/add-click', [GoogleAdsController::class, 'addClick'])->middleware(BasicAuthMiddleware::class);

// Route to add Google Clicks in bulk
Route::post('/add-bulk-json-clicks', [GoogleAdsController::class, 'addBulkJsonClicks'])->middleware(BasicAuthMiddleware::class);

// Route to get Google Clicks with filter
Route::post('/get-clicks', [GoogleAdsController::class, 'getClicks'])->middleware(BasicAuthMiddleware::class);

// Route to get all Calls
Route::get('/all-calls', [CallsController::class, 'allCalls'])->middleware(BasicAuthMiddleware::class);

// Route to register calls
Route::post('/add-call', [CallsController::class, 'addCall'])->middleware(BasicAuthMiddleware::class);
