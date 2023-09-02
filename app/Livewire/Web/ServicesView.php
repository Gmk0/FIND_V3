<?php

namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;
use App\Models\Freelance;
use App\Models\Service;
use Livewire\WithPagination;



#[Layout('layouts.web-layout')]
class ServicesView extends Component
{

    use WithPagination;
    public  $servicesBest;
    public $freelances;

    public $services;

    public function mount()
    {
        $this->servicesBest =
            Service::withCount('orders') // La méthode withCount compte automatiquement le nombre d'orders associés.
            ->where('is_publish', true)
            ->orderByDesc('orders_count')
            ->limit(20)
            ->get();


        $this->freelances = Freelance::limit(20)->get();

        $this->services
            = Service::withCount('orders') // La méthode withCount compte automatiquement le nombre d'orders associés.
            ->where('is_publish', true)
            ->orderByDesc('orders_count')
            ->limit(8)
            ->get();
    }

    public function intiState()
    {


        $this->servicesBest =
            Service::withCount('orders') // La méthode withCount compte automatiquement le nombre d'orders associés.
            ->where('is_publish', true)
            ->orderByDesc('orders_count')
            ->limit(20)
            ->get();
    }


    public function render()
    {
        return view('livewire.web.services-view', ['categories' => Category::all()]);
    }
}
