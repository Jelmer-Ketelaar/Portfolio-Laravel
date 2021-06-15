<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Stripe\Charge;
use Stripe\Stripe;


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
        $product = Product::find($id);
        /* Check if cart already exists.
        If the cart does exist it wil retrieve it.
        If the cart does not exist, it will be null */
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product');
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


    public function postCheckout(Request $request)
    {
        $hasCart = Session::has('cart');

        if ( ! $hasCart)
        {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $stripe = new \Stripe\StripeClient(
            'sk_test_51IvOsWIjTEeTR2CJrdrH0swsotXoQ34XQC0wKtcn2Aj9wSbn8ErJWxJVbv4GnVJhPcEDR6oVe9yGOEyvzFRVZQvo00t2KNqzIl-'
        );
        try
        {
            $charge = $stripe->charges->create([
                "amount" => $cart->totalPrice * 100,
                "currency" => "euro",
                "source" => $request->input('stripeToken'), //obtained with stripe.js
                "description" => "Test Charge",
            ]);

            $order = new Order();
            $order->cart = serialize($cart); // take my php object and convert it to a string and store in database
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            
            Auth::user()->orders()->save($order);
        } catch (\Exception $e)
        {
            return redirect()->route('product')->with('error', $e->getMessage());
        }

        Session::forget('cart');

        return redirect()->route('product')->with('success', 'Successfully purchased products!');
    }
}
        