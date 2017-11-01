<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $description = json_decode($item->description, true);
        $item_price = floatval($description['price']);
        $storedItem = ['qty' => 0, 'total_item_price' => $item_price, 'item' => $item];

        if($this->items)
        {
            if (array_key_exists($id, $this->items))
            {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['total_item_price'] = $item_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item_price;
    }

    public function reduceByOne($id)
    {
        $description = json_decode($this->items[$id]['item']['description'], true);
        $item_price = floatval($description['price']);

        $this->items[$id]['qty']--;
        $this->items[$id]['total_item_price']-= $item_price;
        $this->totalQty--;
        $this->totalPrice -= $item_price;

        if($this->items[$id]['qty'] <= 0 )
        {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['total_item_price'];
        unset($this->items[$id]);
    }
}