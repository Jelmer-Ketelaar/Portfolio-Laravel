<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Facades\CartFacade;

class Header extends Component
{
    public $cartTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount(): void
    {
        $this->cartTotal = count(CartFacade::get()['products']);
    }

    public function render(): View
    {
        return view('livewire.header');
    }

    public function updateCartTotal(): void
    {
        $this->cartTotal = count(CartFacade::get()['products']);
    }
}