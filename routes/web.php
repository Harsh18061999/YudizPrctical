<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\ProductController as UserProduct;
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
    return view('login');
});

//login & logout
Route::POST('/logout',[LoginController::class,'logout'])->name('logout');
Route::POST('/login',[LoginController::class,'login'])->name('login');

Route::group(['middleware' => ['auth']], function () { 

    //admin route
    Route::prefix('admin')->group(function () {
        Route::resource('products',ProductController::Class); //Product details
        Route::get('/order/{top10?}',[OrderController::Class,'index'])->name('order.details'); //order details
    });

    //User route
    Route::prefix('user')->group(function () {
        Route::get('/dashboard',[UserProduct::class,'index'])->name('dashboard');
        Route::get('/add-to-cart/{id}',[UserProduct::class,'addToCart'])->name('addToCart');
        Route::get('/cart',[UserProduct::class,'cart'])->name('cart');
        Route::patch('/update-cart', [UserProduct::class, 'updateCart'])->name('updateCart');
        Route::delete('/remove-cart', [UserProduct::class, 'removeCart'])->name('removeCart');
        Route::get('/checkout',[UserProduct::Class,'checkout'])->name('checkout');
        Route::POST('/order',[UserProduct::Class,'order'])->name('order');
    });

});
