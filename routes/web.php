<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAdsController;
use App\Http\Middleware\BasicAuthMiddleware;

Route::get('/', function () {
    return '<h1>API Mode Only</h1>';
});

Route::get('/test-middleware', function () {
    return '<h1>API Mode Only</h1>';
})->middleware(BasicAuthMiddleware::class);