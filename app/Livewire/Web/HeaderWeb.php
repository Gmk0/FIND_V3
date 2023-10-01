<?php

namespace App\Livewire\Web;

use App\Models\Category;
use Livewire\Component;
use App\Tools\Cart;
use Illuminate\Support\Facades\Session;

class HeaderWeb extends Component
{
    public $products;
    public $isHome =false;
    protected $listeners = ['refreshComponent' => 'refresh'];

    public function refresh()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->products = $cart->items;
    }

    public function mount()
    {
        $this->isHome = request()->routeIs('home');
    }

    public function render()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->products = $cart->items;
        return view('livewire.web.header-web', ['categories' => Category::all()]);
    }
}
