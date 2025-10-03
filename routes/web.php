<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'sitesetting'], function () {
    Route::get('/', [PageHomeController::class, 'index'])->name('index');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/finish', [PageController::class, 'finish'])->name('finish');
    Route::get('/la-cave', [PageController::class, 'cave'])->name('cave');
    Route::get('/la-produits-locaux', [PageController::class, 'localProducts'])->name('local.products');
    Route::get('/bon-plans', [PageController::class, 'promotions'])->name('bon.plans');
    Route::get('/bon-plans/{slug}', [PageController::class, 'promotion'])->name('promotion');
    Route::post('/contact/save', [AjaxController::class, 'contactsave'])->name('contact.save');

    Route::get('/product', [PageController::class, 'allProduct'])->name('all.product');

    Route::get('/sections/{section?}/{category?}', [PageController::class, 'product'])->name('sections');

    Route::get('/men/{slug?}', [PageController::class, 'product'])->name('menproduct');
    Route::get('/women/{slug?}', [PageController::class, 'product'])->name('womenproduct');
    Route::get('/children/{slug?}', [PageController::class, 'product'])->name('childrenproduct');
    Route::get('/sales', [PageController::class, 'saleproduct'])->name('sale-product');

    Route::get('/product/{slug}', [PageController::class, 'productdetail'])->name('productdetail');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cartadd');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cartremove');
    Route::post('/cart/couponcheck', [CartController::class, 'couponcheck'])->name('coupon.check');
    Route::post('/cart/newQty', [CartController::class, 'updateCart'])->name('cartnewQty');
    Route::get('/cart/form', [CartController::class, 'cartform'])->name('cart.form');
    Route::post('/cart/save', [CartController::class, 'cartSave'])->name('cart.save');

    Route::get('/pack/item', [PageController::class, 'showPackItem'])->name('pack.item');

    Auth::routes();
    //Route::get('/logout', [AjaxController::class, 'logout'])->name('logout');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/submit-order', [OrderController::class, 'submit'])->name('order.submit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/run-setup', function () {
    Artisan::call('migrate:fresh', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return 'Setup executed.';
});
