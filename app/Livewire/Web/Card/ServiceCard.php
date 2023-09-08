<?php

namespace App\Livewire\Web\Card;

use App\Models\Service;
use Livewire\Component;

class ServiceCard extends Component
{

    public Service $service;
   // protected $listeners = ['refreshComponentForLike' => '$refresh'];
    public function render()
    {
        return view('livewire.web.card.service-card');
    }
}
