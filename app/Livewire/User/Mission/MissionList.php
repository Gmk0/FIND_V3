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

    protected $listeners =['refresh', '$refresh'];

    public $masquer= false;



    public function demasquer()
    {

         $this->masquer = !$this->masquer;


    }
    public function masquerMission($id)
    {


        try{
            $mission = Mission::find($id);

            if($mission->masquer){

                $mission->masquer = false;
            }else{

                $mission->masquer = true;
            }



            $mission->update();

            $this->dispatch('notify', ['message' => "Projet Modifier", 'icon' => 'success',]);

            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->dispatch('notify', ['message' => "Erreur survenue", 'icon' => 'danger',]);


        }



    }


    public function render()
    {

        $query= Mission::where('user_id', auth()->user()->id)
        ->where('masquer',$this->masquer)
        ->orderBy('created_at','desc');
        return view('livewire.user.mission.mission-list', ['projets' => $query->paginate(10),]);
    }
}
