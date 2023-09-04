<?php

namespace App\Livewire\Web\Card;


use Livewire\Component;
use App\Tools\cart;
use Illuminate\Support\Facades\Session;

class CartService extends Component
{
   protected $listeners = ['refreshComponent' => 'refresh'];
    public  $products;
    public $code;



    public function  refresh()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->products
            = $cart->items;
    }

    public function updateQty($id, $qty)
    {




        // dd($qty);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new cart($oldCart);


        $cart->updateQty($id, $qty);


        Session::put('cart', $cart);

        $new =  Session::get('cart');


        $this->dispatch('refreshCheckout');
    }


    public function remove($id)
    {
        try {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new cart($oldCart);


            $cart->removeItem($id);
            if (count($cart->items) > 0) {
                Session::put('cart', $cart);

                $this->dispatch('refreshComponent');
            } else {
                Session::forget('cart');

                $this->dispatch('refreshComponent');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function render()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->products
            = $cart->items;
   return view('livewire.web.card.cart-service');
    }
}
