<?php

namespace App\Livewire\Freelance\Paiement;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.freelance-layout')]
#[Title('Paiement')]
class PaiementFreelance extends Component
{
    public function render()
    {
        return view('livewire.freelance.paiement.paiement-freelance');
    }
}
