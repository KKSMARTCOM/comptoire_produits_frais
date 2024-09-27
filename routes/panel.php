<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PackController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\LogController;

Route::group(['middleware' => ['auth'], 'prefix' => 'panel', 'as' => 'panel.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/statistics', [DashboardController::class, 'getOrderStatistics'])->name('statistics');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::put('/user{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    // setting route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/add', [SettingController::class, 'create'])->name('setting.create');
    Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
    Route::put('/setting/update', [SettingController::class, 'update'])->name('setting.update');
    Route::delete('/setting/destroy', [SettingController::class, 'destroy'])->name('setting.destroy');
    Route::get('/logs', [SettingController::class, 'logs'])->name('setting.logs');

    // product route
    Route::resource('/product', ProductController::class)->except('destroy');
    Route::delete('/product/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/product-status/update', [ProductController::class, 'status'])->name('product.status');
    Route::get('/get-products/{categoryId}', [ProductController::class, 'productsByCategories'])->name('product.categories');

    // promotions route
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store'); // Changer `create` en `store`
    Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update'); // Changer `delete` en `put`
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');

    Route::get('/get-products/{category_id}', [PromotionController::class, 'getProducts'])->name('get-products');


    // order route
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::get('/order/{id}/show', [OrderController::class, 'show'])->name('order.show');
    Route::put('/order/{id}/update', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::post('/order-status/update', [OrderController::class, 'status'])->name('order.status');
    Route::post('/order-quantity/update', [OrderController::class, 'change'])->name('order.change');

    // Afficher le formulaire de réinitialisation de mot de passe
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    // Envoyer l'e-mail de réinitialisation de mot de passe
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Afficher le formulaire de réinitialisation de mot de passe avec token
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Réinitialiser le mot de passe
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});
