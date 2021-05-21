<?php


namespace App\Models;


class Cart {
    public function __construct()
    {
        if ($this->get() === null) {
            $this->set($this->empty());
        }
    }

    public function add(Product $product): void
    {
        $cart = $this->get();
        $cart['products'][] = $product;
        $this->set($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        array_splice($cart['products'], array_search($productId, array_column($cart['products'], 'id'), true), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'products' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }
}