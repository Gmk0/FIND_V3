<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Mission')]
class MissionList extends Component
{
    public $title = "Mes Missions";
    use WithPagination;


    public function render()
    {
        return view('livewire.user.mission.mission-list', ['projets' => Mission::where('user_id', auth()->user()->id)->paginate(10),]);
    }
}
