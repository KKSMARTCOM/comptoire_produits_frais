<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PackController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;

Route::group(['middleware' => ['auth'], 'prefix' => 'panel', 'as' => 'panel.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // pack route
    Route::get('/pack', [PackController::class, 'index'])->name('pack.index');
    Route::get('/pack/add', [PackController::class, 'create'])->name('pack.create');
    Route::get('/pack/{id}/edit', [PackController::class, 'edit'])->name('pack.edit');
    Route::post('/pack/store', [PackController::class, 'store'])->name('pack.store');
    Route::put('/pack/{id}/update', [PackController::class, 'update'])->name('pack.update');
    Route::delete('/pack/destroy', [PackController::class, 'destroy'])->name('pack.destroy');
    Route::post('/pack-status/update', [PackController::class, 'status'])->name('pack.status');

    // category route
    Route::resource('/category', CategoryController::class)->except('destroy'); // destroy çıkartılır.
    Route::delete('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category-status/update', [CategoryController::class, 'status'])->name('category.status');

    // user route
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}/show', [UserController::class, 'show'])->name('user.show');
    Route::post('/user{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    // contact route
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact-status/update', [ContactController::class, 'status'])->name('contact.status');

    // setting route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/add', [SettingController::class, 'create'])->name('setting.create');
    Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
    Route::put('/setting/{id}/update', [SettingController::class, 'update'])->name('setting.update');
    Route::delete('/setting/destroy', [SettingController::class, 'destroy'])->name('setting.destroy');

    // product route
    Route::resource('/product', ProductController::class)->except('destroy');
    Route::delete('/product/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/product-status/update', [ProductController::class, 'status'])->name('product.status');

    // order route
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{id}/update', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::post('/order-status/update', [OrderController::class, 'status'])->name('order.status');
    Route::post('/order-quantity/update', [OrderController::class, 'change'])->name('order.change');
});
