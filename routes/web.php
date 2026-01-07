<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/collections', [PageController::class, 'collection'])->name('collection');
Route::get('/products', [PageController::class, 'collection'])->name('products');
Route::get('/all-products', [PageController::class, 'allProducts'])->name('all-products');
Route::get('/combos', [PageController::class, 'combos'])->name('combos');
Route::get('/combo', [PageController::class, 'combo'])->name('combo'); // Singular for checking specific combo?
Route::get('/cosmopolitan', [PageController::class, 'cosmopolitan'])->name('cosmopolitan'); // Special collection
Route::get('/product', [PageController::class, 'product'])->name('product'); // Should probably accept an ID/slug
Route::view('/about', 'azwa.about')->name('about');
Route::view('/contact', 'azwa.contact')->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/shipping-policy', [PageController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return-policy');
Route::get('/terms-of-service', [PageController::class, 'termsOfService'])->name('terms-of-service');
Route::post('/order/place', [OrderController::class, 'store'])->name('order.place');
