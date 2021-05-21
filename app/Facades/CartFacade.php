<?php

namespace App\Facades;


use App\Product;
use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jcart';
    }
}