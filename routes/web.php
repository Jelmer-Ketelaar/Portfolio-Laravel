<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

//posts = index
Route::get('/', function () {
    return view('/index');
});

Route::get('/products', 'ProductController@index');
Route::get('cart', [CartController::class, 'index'])
    ->name('cart');

Route::get('/home', function () {
    return view('/home');
});

Route::get('/register', function () {
    return view('/register');
});

require __DIR__ . '/auth.php';
