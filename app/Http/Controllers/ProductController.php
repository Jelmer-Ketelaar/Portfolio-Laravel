<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function getAddToCart(Request $request, $id): RedirectResponse
    {
        // Trying to get product from the database with the eloquent method 'find'
        $product = Product::find($id);
        /* Check if cart already exists.
        If the cart does exist it wil retrieve it.
        If the cart does not exist, it will be null */
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return back();
    }

    public function getCart()
    {
        if ( ! Session::has('cart'))
        {
            return view('shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shop.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }


    /**
     * success response method.
     *
     * @return Factory|Application|View
     */
    public function getCheckout()
    {
        if ( ! Session::has('cart'))
        {
            return view('shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $products = Product::all();

        return view('shop.checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * success response method.
     * @return RedirectResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function postCheckout(Request $request)
    {
        $hasCart = Session::has('cart');
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        if ( ! $hasCart)
        {
            return redirect()->route('shop.checkout');
        }

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->save();

        Session::forget('cart');

        return redirect()->route('product')->with(Session::flash('success', 'Payment successful!'));
    }
}