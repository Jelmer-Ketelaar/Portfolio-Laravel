<?php

namespace App\Http\Controllers;


use App\Models\Product;
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
}
        