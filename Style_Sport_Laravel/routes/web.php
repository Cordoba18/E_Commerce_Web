<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RecoveryPasswordController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ShoppingHistryController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthenticatedSessionController::class, 'index'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::get('/register', [RegisteredUserController::class, 'index'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/verification', [RegisteredUserController::class, 'verification'])->name('verification');
Route::post('/verification', [RegisteredUserController::class, 'validation'])->name('verification.validate');
Route::get('/recoverypassword', [RecoveryPasswordController::class, 'index'])->name('recoverypassword');

Route::get('/productcatalog', [ProductController::class, 'index'])->name('productcatalog');
Route::get('/productprofile/{product}', [ProductController::class, 'show'])->name('productprofile');

Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shoppingcart');
Route::get('shoppingcart/delete/{id}', [ShoppingCartController::class, 'delete'])->name('shoppingcart.delete');
Route::post('shoppingcart/editquantity', [ShoppingCartController::class, 'editquantity'])->name('shoppingcart.editquantity');
Route::post('/shoppingcart/store', [ShoppingCartController::class, 'store'])->name('shoppingcart.store');
Route::get('/shoppingcart/comprar', [ShoppingCartController::class, 'comprar'])->name('shoppingcart.comprar');
Route::get('shoppingcart/seleccionar/{id}', [ShoppingCartController::class, 'seleccionar'])->name('shoppingcart.seleccionar');
Route::get('shoppingcart/cancelar_seleccion/{id}', [ShoppingCartController::class, 'cancelar_seleccion'])->name('shoppingcart.cancelar_seleccion');
Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist');

Route::get('/customerprofile', [CustomerProfileController::class, 'index'])->name('customerprofile');

Route::get('/paymentmethod', [PaymentMethodController::class, 'index'])->name('paymentmethod');
Route::get('/paymentmethod/create', [PaymentMethodController::class, 'create'])->name('paymentmethod.create');

Route::get('/shoppinghistory', [ShoppingHistryController::class, 'index'])->name('shoppinghistory');

Route::get('/purchaseform', [PurchaseController::class, 'index'])->name('paymentmethod');
Route::get('/purchaseconfirmation', [PurchaseController::class, 'show'])->name('paymentmethod.create');
