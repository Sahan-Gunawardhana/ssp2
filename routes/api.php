<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('appointment', AppointmentController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('boxes', BoxController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('user', UserController::class);

