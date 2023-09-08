<?php

namespace App\Livewire\User\Other;

use App\Models\Favorite;
use App\Models\Service;
use App\Tools\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Favoris')]

class FavorisList extends Component
{

    protected $listeners = ['refreshFavorite' => 'refresh'];



    public function getFavorites()
    {
        $user = auth()->user();

        if ($user) {
            return $user->favoritesService()->get();
        }

        return collect();
    }

    public function getFreelanceFavorites()
    {
        $user = auth()->user();

        if ($user) {
            return $user->favoritesFreelance()->get();
        }

        return collect();
    }

    public function toogleFavorite($serviceId)
    {

        $favorite = favorite::where('user_id', auth()->id())
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
        $this->dispatch('refreshFavorite')->to(FavorisList::class);
    }

    public function add_cart($id)
    {

        $service = Service::find($id);
        $files = $service->files;
        foreach ($files as $key => $file) {
            $images = $file;
            break;
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($service, $service->id, $images);
        Session::put('cart', $cart);

        $this->dispatch('refreshComponent');

    }


    public function render()
    {
        return view('livewire.user.other.favoris-list', [
            'favoris' => $this->getFavorites(),
            'freelance' => $this->getFreelanceFavorites(),
        ]);
    }
}
