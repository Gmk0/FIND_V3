<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use App\Models\MissionResponse as ModelsMissionResponse;
use Exception;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Actions\Action;

#[Layout('layouts.user-layout')]

#[Title('Mission ')]
class MissionResponse extends Component

implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

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

    public function acceptera($id)
    {

        try {


            $Response = MissionResponse::find($id);
            $Response->status = 'approved';
            $Response->update();

            $this->dispatch('notify', ['message' => "Vous avez accepter cette mission ", 'icon' => 'success',]);
           // $Response->notifyFreelance();
           // $mission = Mission::findOrFail($Response->mission_id)->update(['status' => 'en cours', 'visible' => false]);

           // event(new Response($Response));

            $this->dispatch('refresh');
        } catch (\Exception $e) {
        }
    }

    public function refuser($id)
    {

        try{

            $Response = ModelsMissionResponse::findOrfail($id);
            $Response->status = 'rejected';
            $Response->update();
       // $Response->notifyFreelance();

        }catch(\Exception $e){

        }






       // event(new Response($Response));
    }


    public function accepterAction(): Action
    {
        try{

            return Action::make('accepter')
                ->requiresConfirmation()
                ->modalHeading('Accepter la proposition')
                ->modalDescription('Êtes-vous sûr de vouloir accepter cette proposition du freelance ? En acceptant, toutes les autres propositions seront automatiquement refusées et ne pourront pas être récupérées.')
                ->modalSubmitActionLabel('Oui, Accepter')
                ->color('success')
                ->modalIcon('heroicon-o-pencil')
                ->modalIconColor('success')
                ->action(function (array $arguments) {
                   $missionResponse = ModelsMissionResponse::find($arguments['id']);
                   $missionResponse->status = 'approved';
                    $missionResponse->update();
                    $this->dispatch('notify', ['message' => "Vous avez accepter cette mission ", 'icon' => 'success',]);
                   $mission = Mission::findOrFail($missionResponse->mission_id)->update(['status' => 'active']);
                   $missionResponse->notifyFreelance();
                   $this->dispatch('refresh');
                });

        }catch(\Exception $e){

            dd($e->getMessage());

        }


    }

    public function refuserAction(): Action
    {
        return Action::make('refuser')
        ->requiresConfirmation()
            ->modalHeading('Refuser la mission')
            ->modalDescription('Êtes-vous sûr de vouloir refuser cette proposition du freelance ?.')
            ->modalSubmitActionLabel('Oui, Refuser')
            ->color('danger')
            ->modalIcon('heroicon-o-pencil')
            ->modalIconColor('danger')
            ->action(function (array $arguments) {
                $post = MissionResponse::find($arguments['id']);
            });
    }






    public function render()
    {
        $this->proposition = ModelsMissionResponse::where('mission_id', $this->mission->id)->get();
        return view('livewire.user.mission.mission-response');
    }
}
