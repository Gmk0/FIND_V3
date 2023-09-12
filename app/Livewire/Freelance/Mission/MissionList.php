<?php

namespace App\Livewire\Freelance\Mission;

use App\Models\Mission;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]
class MissionList extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.freelance.mission.mission-list', [
            'projets' => Mission::where('status', 'pending')->where('is_paid', null)->paginate(10),
        ]);
    }
}
