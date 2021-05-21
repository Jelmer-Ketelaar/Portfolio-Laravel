<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Product::all();
        return view('livewire.cart', compact('cart', $cart));
    }
}
