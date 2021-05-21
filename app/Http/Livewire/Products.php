<?php

namespace App\Http\Livewire;


use app\Facades\Cart;
use Livewire\Component;

class Products extends Component {
    public function addToCart(int $productId): void
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->emit('productAdded');
    }
}