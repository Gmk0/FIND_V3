<?php

namespace App\Tools;


class Cart
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart)
    {

        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }


    public function add($item, $id, $image, $price = null, $level = 'Basic')
    {
        // Vérifier si le tableau est vide au départ
        if (empty($this->items)) {
            $this->items = [];
        }

        // Vérifier si l'élément existe déjà dans la liste avec un niveau différent
        foreach ($this->items as $itemId => $storedItem) {
            if ($storedItem['id'] === $item->id && $storedItem['level'] !== $level) {
                // Supprimer l'ancien élément avec un niveau différent
                $this->totalQty -= $storedItem['quantity'];
                $this->totalPrice -= $storedItem['basic_price'] * $storedItem['quantity'];
                unset($this->items[$itemId]);
            }
        }

        // Vérifier si l'élément existe déjà dans la liste avec le même niveau
        $existingItem = null;
        foreach ($this->items as $itemId => $storedItem) {
            if ($storedItem['id'] === $item->id && $storedItem['level'] === $level) {
                $existingItem = $itemId;
                break;
            }
        }



        if ($existingItem !== null) {
            // L'élément existe déjà avec le même niveau, augmenter la quantité
            $this->items[$existingItem]['quantity'] += 1;

            $this->totalQty++;

            $this->totalPrice += $price ? $price : $item->basic_price;
        } else {
            // L'élément n'existe pas avec le même niveau, créer un nouvel élément dans la liste
            $storedItem = [
                'quantity' => 1, 'id' => $item->id, 'title' => $item->title, 'level' => $level,
                'basic_price' => $price ? $price : $item->basic_price, 'image' => $image, 'item' => $item
            ];

            $this->totalQty++;
            $this->totalPrice += $price ? $price : $item->basic_price;
            $this->items[$id] = $storedItem;
        }
    }







    public function updateQty($id, $qty)
    {

        $this->totalQty -= $this->items[$id]['quantity'];

        $this->totalPrice -= $this->items[$id]['basic_price'] * $this->items[$id]['quantity'];
        $this->items[$id]['quantity'] = $qty;
        $this->totalQty += $qty;

        $this->totalPrice += $this->items[$id]['basic_price'] * $qty;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['quantity'];
        $total = $this->items[$id]['basic_price'] * $this->items[$id]['quantity'];
        //dd($total);

        $this->totalPrice -= $this->items[$id]['basic_price'] * $this->items[$id]['quantity'];
        unset($this->items[$id]);
    }
}
