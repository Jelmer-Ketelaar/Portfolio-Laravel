<?php

namespace App\Http\Livewire;


use Livewire\Component;


class Cart extends Component {
    public $cart;

    public function mount(): void
    {
        $this->cart = \App\Facades\CartFacade::get();
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeFromCart($productId): void
    {
        CartFacade::remove($productId);
        $this->cart = CartFacade::get();
        $this->emit('productRemoved');
    }

    public function checkout(): void
    {
        CartFacade::clear();
        $this->emit('clearCart');
        $this->cart = CartFacade::get();
    }
}