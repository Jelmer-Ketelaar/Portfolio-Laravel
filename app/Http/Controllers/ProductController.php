<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        return redirect()->route('product');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('livewire.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('livewire.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice,]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('livewire.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $products = Product::all();
        return view('livewire.checkout', ['total' => $total], compact('products'));
    }

    public function postCheckout(request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "euro",
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order) ;
        } catch (\Exception $e) {
            return redirect()->route('product')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product')->with('succes', 'Succesfully purchased products!');
    }
}
        