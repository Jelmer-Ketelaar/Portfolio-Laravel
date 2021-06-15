<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
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

Route::get('stripe', 'StripeController@stripe')
    ->name('stripe')
    ->middleware('auth');

Route::post('/stripe', 'StripeController@stripePost')
    ->name('stripe.post')
    ->middleware('auth');

Route::get('/register', function () {
    return view('/register');
});


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


require __DIR__ . '/auth.php';
