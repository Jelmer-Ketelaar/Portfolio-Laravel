<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;


class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products', $products));
    }

    public function getAddToCart(Request $request, $id)
    {
        // Trying to get product from the database with the eloquent method 'find'
        $product = Product::find($request->$id);
        /* Check if cart already exists.
        If the cart does exist it wil retrieve it.
        If the cart does not exist, it will be null */
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $request->amount);

        $request->session()->put('cart', $cart);

        return redirect()->route('product');
    }

    public function getCart()
    {
        if ( ! Session::has('cart'))
        {
            return view('livewire.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('livewire.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if ( ! Session::has('cart'))
        {
            return view('livewire.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $products = Product::all();

        return view('livewire.checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }


    public function postCheckout(Request $request)
    {
        if ( ! Session::has('cart'))
        {
            return redirect()->route('livewire.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');

        Auth::user()->orders()->save($order);

        return redirect()->route('product')->with('succes', 'Succesfully purchased products!');
    }
}
        