<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//posts = index
Route::get('/', function () {
    return view('/index');
});

Route::get('/', 'ProductController@getProducts');
Route::get('/cart', Cart::class);

Route::get('/home', function () {
    return view('/home');
});

Route::get('/register', function () {
    return view('/register');
});

require __DIR__ . '/auth.php';
