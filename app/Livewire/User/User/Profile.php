<?php

namespace App\Livewire\User\User;

use Livewire\Component;


use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Profile')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.user.user.profile');
    }
}
