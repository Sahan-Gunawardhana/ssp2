<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('products', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
    Route::get('/products/{id}', [ProductController::class, 'apiShow']);
    // Other resource routes that require authentication
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('boxes', BoxController::class);
    Route::apiResource('users', UserController::class);
});

