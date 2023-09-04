<?php

namespace App\Livewire\Web;

use Livewire\Component;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.web-layout')]
#[Title('Creer missiion')]

class ServicesByCategory extends Component
{
    public function render()
    {
        return view('livewire.web.services-by-category');
    }
}
