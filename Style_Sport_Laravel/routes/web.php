<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RecoveryPasswordController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ShoppingHistryController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\InvoiceDetailsController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login_inicio', [AuthenticatedSessionController::class, 'index'])->name('login');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/acount/delete', [CustomerProfileController::class, 'destroy'])->name('customer.delete');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::get('register_Inicio', [RegisteredUserController::class, 'index'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/verification', [RegisteredUserController::class, 'verification'])->name('verification');
Route::post('verification_code', [RegisteredUserController::class, 'validation'])->name('verification.validate');
Route::get('/recoverypassword', [RecoveryPasswordController::class, 'index'])->name('recoverypassword');
Route::get('delete/code/{correo}', [RegisteredUserController::class, 'delete_code'])->name('verification.delete_code');
Route::get('/vista_validar', [RegisteredUserController::class, 'vista_validar'])->name('verification.vista_validar');

Route::get('/productcatalog', [ProductController::class, 'index'])->name('productcatalog');
Route::get('/productprofile/{product}', [ProductController::class, 'show'])->name('productprofile');
Route::post('productprofile/calificar', [ProductController::class, 'calificar'])->name('productprofile.calificar');

Route::get('/shoppingcart', [ShoppingCartController::class, 'index'])->name('shoppingcart');
Route::get('shoppingcart/delete/{id}', [ShoppingCartController::class, 'delete'])->name('shoppingcart.delete');
Route::post('shoppingcart/editquantity', [ShoppingCartController::class, 'editquantity'])->name('shoppingcart.editquantity');
Route::post('/shoppingcart/store', [ShoppingCartController::class, 'store'])->name('shoppingcart.store');
Route::get('/shoppingcart/comprar', [ShoppingCartController::class, 'comprar'])->name('shoppingcart.comprar');
Route::get('shoppingcart/seleccionar/{id}', [ShoppingCartController::class, 'seleccionar'])->name('shoppingcart.seleccionar');
Route::get('shoppingcart/cancelar_seleccion/{id}', [ShoppingCartController::class, 'cancelar_seleccion'])->name('shoppingcart.cancelar_seleccion');

Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist');
Route::get('/wishlist/store/{id}', [WishListController::class, 'store'])->name('wishlist.store');
Route::get('wishlist/delete/{id}', [WishListController::class, 'delete'])->name('wishlist.delete');

Route::get('/customerprofile', [CustomerProfileController::class, 'index'])->name('customerprofile');
Route::post('/customerprofile/store', [CustomerProfileController::class, 'store'])->name('customerprofile.store');

Route::get('/shoppinghistory', [ShoppingHistryController::class, 'index'])->name('shoppinghistory');

Route::get('/purchaseform', [PurchaseController::class, 'index'])->name('purchaseform');
Route::get('/purchaseconfirmation', [PurchaseController::class, 'show'])->name('purchaseform.create');
Route::post('purchaseform/purchasefacturar', [PurchaseController::class, 'facturar'])->name('purchaseform.facturar');
Route::post('purchaseform/save_changes', [PurchaseController::class, 'save_changes'])->name('purchaseform.save_changes');
Route::get('/purchasevalidar', [PurchaseController::class, 'validar'])->name('purchaseform.validar');

Route::get('/InvoiceDetails/{id}', [InvoiceDetailsController::class, 'index'])->name('InvoiceDetails');

