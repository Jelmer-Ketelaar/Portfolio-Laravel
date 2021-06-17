<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//posts = index
Route::get('/', function () {
    return view('/index');
});

Route::get('/products', 'ProductController@index')
    ->name('product');

Route::get('cart', 'ProductController@getCart')
    ->name('shop.cart');

Route::get('/cart/{id}', 'ProductController@getAddToCart')
    ->name('product.addToCart');

Route::get('checkout', 'ProductController@getCheckout')
    ->name('checkout')
    ->middleware('auth');

Route::post('/checkout', 'ProductController@postCheckout')
    ->name('checkout.post')
    ->middleware('auth');

Route::get('/register', function () {
    return view('/register');
});


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


require __DIR__ . '/auth.php';
