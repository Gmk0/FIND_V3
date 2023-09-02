<?php

namespace App\Livewire\Web\Registration;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.web-layout')]

class RegisterEtape1 extends Component
{
    public function render()
    {
        return view('livewire.web.registration.register-etape1');
    }
}
