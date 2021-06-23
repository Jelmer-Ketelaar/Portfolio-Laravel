<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart
{
    //holds the individual products.
    //Group of products
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    //Pass the old card
    public function __construct($oldCart)
    {
        //check if oldCart does exist
        //if it does exist items will be equal to oldCart items
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
//        dd($this->totalPrice, $item->price);
        $this->totalPrice += $item->price;
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
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id] ['qty'];
        $this->totalPrice -= $this->items[$id] ['price'];
        unset($this->items[$id]);
    }

    public function addByOne($id)
    {
        $this->items [$id] ['qty']++;
        $this->items [$id] ['price'] += $this->items[$id] ['item'] ['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id] ['item'] ['price'];
    }
}