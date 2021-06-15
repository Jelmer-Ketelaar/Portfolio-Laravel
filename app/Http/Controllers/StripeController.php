<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Order;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return Factory|Application|View
     */
    public function stripe()
    {
        return view('shop.stripe');
    }

    /**
     * success response method.
     *
     * @return RedirectResponse
     * @throws Stripe\Exception\ApiErrorException
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Good test"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}