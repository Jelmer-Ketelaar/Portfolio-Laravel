<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Cart;

class CartController extends Controller
{
    public function index()
    {
//        $cart = Cart::all();
        return view('livewire.cart');
    }
}
