<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

//posts = index
Route::get('/', function () {
    return view('/index');
});

Route::get('/products', 'ProductController@index')
    ->name('product');

Route::get('cart', 'ProductController@getCart')
    ->name('product.cart');

Route::get('/cart/{id}', 'ProductController@getAddToCart')
    ->name('product.addToCart');

Route::get('/checkout', 'ProductController@getCheckout')
    ->name('checkout');

Route::post('/checkout', 'ProductController@postCheckout')
    ->name('checkout');

Route::get('/register', function () {
    return view('/register');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


require __DIR__ . '/auth.php';
