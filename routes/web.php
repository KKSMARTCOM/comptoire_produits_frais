<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
use App\Http\Controllers\Backend\UserController;

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
    Route::post('/contact/save', [AjaxController::class, 'contactsave'])->name('contact.save');
    Route::get('/product', [PageController::class, 'product'])->name('product');
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

    Auth::routes();
    //Route::get('/logout', [AjaxController::class, 'logout'])->name('logout');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route pour la page des produits
Route::get('/products', [App\Http\Controllers\Frontend\Products\ProductController::class, 'products'])->name('products');

Route::post('/submit-order', [OrderController::class, 'submit'])->name('order.submit');

// Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Routes pour les utilisateurs
/* Route::prefix('panel/user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('panel.user.index');      // Lister les utilisateurs
    // Route::get('/panel/user', [UserController::class, 'index'])->name('panel.user.index');

    Route::get('/create', [UserController::class, 'create'])->name('panel.user.create'); // Formulaire de création
    Route::post('/store', [UserController::class, 'store'])->name('panel.user.store');  // Enregistrer un utilisateur
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('panel.user.edit'); // Formulaire d'édition
    Route::put('/update/{id}', [UserController::class, 'update'])->name('panel.user.update'); // Mettre à jour l'utilisateur
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('panel.user.destroy'); // Supprimer un utilisateur
}); */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
