<?php

namespace App\Livewire\Web\Registration;

use Livewire\Component;

use Livewire\Attributes\Layout;

#[Layout('layouts.web-layout')]
class RegisterBegin extends Component
{
    public function render()
    {
        return view('livewire.web.registration.register-begin');
    }
}
