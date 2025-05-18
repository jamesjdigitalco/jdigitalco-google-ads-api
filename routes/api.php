<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAdsController;
use App\Http\Middleware\BasicAuthMiddleware;


Route::post('/test-post', [GoogleAdsController::class, 'testPost'])->middleware(BasicAuthMiddleware::class);