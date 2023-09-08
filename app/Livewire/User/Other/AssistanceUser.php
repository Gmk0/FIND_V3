<?php

namespace App\Livewire\User\Other;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Paiement')]


class AssistanceUser extends Component
{
    public function render()
    {
        return view('livewire.user.other.assistance-user');
    }
}
