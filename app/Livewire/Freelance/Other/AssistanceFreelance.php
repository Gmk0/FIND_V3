<?php

namespace App\Livewire\Freelance\Other;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]

class AssistanceFreelance extends Component
{
    public function render()
    {
        return view('livewire.freelance.other.assistance-freelance');
    }
}
