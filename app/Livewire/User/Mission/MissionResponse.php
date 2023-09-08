<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use App\Models\MissionResponse as ModelsMissionResponse;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Paiement')]
class MissionResponse extends Component
{

    public Mission $mission;
    public $proposition;
    public $proposition_id;

    protected $listeners = ['refresh' => '$refresh'];


    public function mount($mission_numero){


        $exist = Mission::where('mission_numero', $mission_numero)
            ->where('user_id', auth()->id())->exists();



        if ($exist) {

            $this->mission =Mission::where('mission_numero', $mission_numero)
                 ->where('user_id', auth()->id())->first();
        } else {
            return $this->redirect(route('MissionUser'));
        }


    }

    public function accepter($id)
    {

        try {



            // $Response = ProjectResponse::find($id)->update(['status' => 'approved']);
            $Response = MissionResponse::find($id);
            $Response->status = 'accepter';

            $Response->update();
            $Response->notifyFreelance();
            $mission = Mission::findOrFail($Response->project_id)->update(['status' => 'en cours', 'visible' => false]);




            $this->notification()->success(
                $title = "Proposition",
                $description = "Vous avez approuver la proposition",
            );

           // event(new Response($Response));

            $this->emitSelf('refresh');
        } catch (\Exception $e) {
        }
    }

    public function refuser($id)
    {

        $Response = ModelsMissionResponse::findOrfail($id);
        $Response->status = 'rejected';
        $Response->update();
        $Response->notifyFreelance();

        $this->notification()->success(
            $title = "Proposition",
            $description = "Vous avez rejeter la proposition",
        );


       // event(new Response($Response));
    }

    public function render()
    {
        $this->proposition = ModelsMissionResponse::where('mission_id', $this->mission->id)->get();
        return view('livewire.user.mission.mission-response');
    }
}
