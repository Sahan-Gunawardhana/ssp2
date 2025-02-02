<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\ProductController;
use App\Livewire\AppointmentsPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyBoxDetailsPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\Store;
use App\Livewire\StorePage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.home');
    Route::get('/admin/products', function () { return view('admin.manageP');})->name('admin.products');
    Route::get('/admin/users', function () {  return view('admin.manageU');})->name('admin.users');
    Route::get('/admin/orders', function () { return view('admin.manageO');})->name('admin.orders');
    Route::get('delete-appointment/{id}',[AppointmentController::class, 'destroy']);
    Route::get('admin/appointments',[AppointmentController::class, 'adminIndex'])->name('admin.appointments');
    Route::get('admin/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('products.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'store']);
});

Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::get('/store', StorePage::class)->name('store');

Route::get('/store', StorePage::class)->name('store');

Route::middleware('auth', 'user')->group(function () {
    Route::get('/appointments', AppointmentsPage::class)->name('appointments');
    
    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/store/{productId}', ProductDetailPage::class)->name('product.show');
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{orderId}', MyOrderDetailPage::class)->name('my-orders.show');
    Route::get('/my-box/{boxId}', MyBoxDetailsPage::class)->name('my-box.show');
});