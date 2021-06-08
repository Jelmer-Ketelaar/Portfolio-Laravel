<?php

namespace App;


use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart {
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
        if ($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items && array_key_exists($id, $this->items))
        {
            $storedItem = $this->items[$id];
        }
        $storedItem['qty'] ++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty ++;
//        dd($this->totalPrice, $item->price);
        $this->totalPrice += $item->price;
    }

    /**
     * Method to change the amount of items per product
     * @param $item - the product of the amount that needs to be edited.
     * @param $id -
     *
     */
    public function editAmount($item, $id, $newAmount)
    {
        $storedItem = $this->items[$id];

        //To remove old quantity from totalQty property
        $this->totalQty -= $storedItem['qty'];

        //To remove old price from totalPrice property
        $this->totalPrice -= $storedItem['price'];

        if ($newAmount > 0)
        {
            //To assign new values to storedItem
            $storedItem['qty'] = $newAmount;
            $storedItem['price'] = $item->price * $storedItem['qty'];

            //To overwrite old values in items array
            $this->items[$id] = $storedItem;

            $this->totalQty += $storedItem['qty'];
            $this->totalPrice += $storedItem['price'];
        } else
        {
            unset($this->items[$id]);
        }
    }
}