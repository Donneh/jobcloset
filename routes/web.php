<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
Route::middleware('guest')->group(function () {
    Route::redirect('/', '/shop');
    Route::get('/invited/{token}', \App\Livewire\JoinByInvitePage::class)->name('invited');
    Route::get('/register/{token}', \App\Livewire\JoinByInvitePage::class)->name('persistent.invited');
});


Route::middleware('auth')->group(function () {
    Route::get('/user-profile', \App\Livewire\UserProfile::class)->name('user.profile');

    Route::get('/users', \App\Livewire\UserList::class)->name('users.index');

    Route::get('/departments', \App\Livewire\Departments\ListDepartments::class)->name('departments.index');

    Route::get('/locations', \App\Livewire\Departments\ListLocations::class)->name('locations.index');

    Route::get('/products', \App\Livewire\Products\ListProducts::class)->name('products.index');

    Route::get('/job-titles', \App\Livewire\JobTitles\ListJobTitles::class)->name('job-titles.index');

    Route::get('/shop', \App\Livewire\ShopList::class)->name('shop.index');

    Route::get('/cart', \App\Livewire\CartPage::class)->name('cart.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//
    Route::get('/orders', \App\Livewire\Orders\ListOrders::class)->name('orders.index');

    Route::get('/company-settings', \App\Livewire\CompanySettingsPage::class)->name('company-settings.index');
});
