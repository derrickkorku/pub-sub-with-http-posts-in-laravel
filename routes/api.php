<?php

use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::post('publish/{topic}', PublisherController::class);
Route::post('subscribe/{topic}', SubscriberController::class);
