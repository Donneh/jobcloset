<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/users', UserController::class);

    Route::resource('/products', ProductController::class);

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get("/cart/checkout/{status}", [CartController::class, 'checkoutStatus'])->name("cart.checkout.status");
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departments', DepartmentController::class);
    Route::post('/departments/{department}/users', [DepartmentController::class, 'addUser'])->name('departments.addUser');
    Route::delete('/departments/{department}/users', [DepartmentController::class, 'removeUser'])->name('departments.removeUser');

    Route::resource('job-titles', JobTitleController::class);
    Route::post('/job-titles/{jobTitle}/users', [JobTitleController::class, 'addUser'])->name('job-titles.addUser');
    Route::delete('/job-titles/{jobTitle}/users', [JobTitleController::class, 'removeUser'])->name('job-titles.removeUser');

    Route::resource('locations', LocationController::class);
    Route::post('/locations/{location}/users', [LocationController::class, 'addUser'])->name('locations.addUser');
    Route::delete('/locations/{location}/users', [LocationController::class, 'removeUser'])->name('locations.removeUser');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});


Route::post("/payment/create", [PaymentController::class, 'create'])->name('payment.create');

Route::get('/payment/redirect', [PaymentController::class, 'redirect'])->name('payment.redirect');

require __DIR__.'/auth.php';
