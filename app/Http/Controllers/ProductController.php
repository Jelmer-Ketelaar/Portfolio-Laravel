<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use Illuminate\Routing\Controller;
//use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products', $products));
    }

    public function getAddToCart(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($id);
        //check if cart has been stored in the session.
        // If this is the case it will retrieve it with the get method
        // If this is not the case it will be sett to Null
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('product.index');
    }
}
        