<?php

namespace App\Providers;


use App\Models\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('jcart', function () {
            return new Cart();
    });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
