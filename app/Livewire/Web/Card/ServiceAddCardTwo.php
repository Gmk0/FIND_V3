<?php

namespace App\Livewire\Web\Card;

use App\Models\Favorite;
use App\Models\Service;
use App\Tools\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ServiceAddCardTwo extends Component
{

    public Service $service;

    protected $listeners = ['refreshFavorite' => '$refresh'];
    public function toogleFavorite($serviceId)
    {

        $favorite = Favorite::where('user_id', auth()->id())
            ->where('service_id', $serviceId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'service_id' => $serviceId,
            ]);
        }
        $this->emit('refreshFavorite');
    }

    public function add_cart($id)
    {

        $service = Service::find($id);
        $files = $service->files;
        foreach ($files as $key => $file) {
            $images = $file;
            break;
        }

        // dd($images);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($service, $service->id, $images);
        Session::put('cart', $cart);


        $this->dispatch('refreshComponent');



        $this->dispatch('notify', ['message' => "Service ajouter dans le panier", 'icon' => 'success',]);


        // dd(Session::get('cart'));
    }
    public function render()
    {
        return view('livewire.web.card.service-add-card-two');
    }
}
