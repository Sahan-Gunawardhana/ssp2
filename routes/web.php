<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('test', function(){
    $order = App\Models\Order::find(2);
    // return $order->orderItems;

    $box = App\Models\Box::find(1);
    // return $box->boxItems;

    $user = App\Models\User::find(2);
    // return $user->orders;


    $user = App\Models\User::find(3);
    // return $user->appointments;
    // return $user->boxes;
    // return $user->orders;

    $product = App\Models\Product::find(3);
    // return $product->orderItems;
});
