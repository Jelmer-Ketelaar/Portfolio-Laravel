<?php

namespace App;


use Illuminate\Http\Request;

class Cart
{
    //holds the individual products.
    //Group of products
    public $items = [];
    public $totalQty = 0;
    public $totalPrice = 0;

    //Pass the old card
    public function __construct(Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        //check if oldCart does exist
        //if it does exist items will be equal to oldCart items
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
        $this->save();
    }

    public function save()
    {
        session()->put('cart', $this);
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items && array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
//        dd($this->totalPrice, $item->price);
        $this->totalPrice += $item->price;
        $this->save();
    }

    public function reduceByOne($id)
    {
        $this->items [$id] ['qty']--;
        $this->items [$id] ['price'] -= $this->items[$id] ['item'] ['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id] ['item'] ['price'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
        $this->save();
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id] ['qty'];
        $this->totalPrice -= $this->items[$id] ['price'];
        unset($this->items[$id]);
        $this->save();
    }

    public function addByOne($id)
    {
        $this->items [$id] ['qty']++;
        $this->items [$id] ['price'] += $this->items[$id] ['item'] ['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id] ['item'] ['price'];
        $this->save();
    }
}