<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.web-layout')]

#[Title('Contact')]

class ContactView extends Component
{
    public function render()
    {
        return view('livewire.web.other.contact-view');
    }
}
