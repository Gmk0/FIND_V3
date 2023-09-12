<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use App\Models\MissionResponse;
use Exception;
use Livewire\Component;

use Livewire\WithPagination;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Actions\EditAction;
use Filament\Forms\Components\{TextInput, Select};


use Livewire\Attributes\{Layout, Title};
use Illuminate\Database\Eloquent\Model;

use Filament\Actions\Action;

#[Layout('layouts.user-layout')]

#[Title('Mission Edit')]

class MissionGestion extends Component

implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;
    public $response;
    public $projet;
   // public $modal = false;
    public $feedback=['description'=>''];
    public $satisfaction = 0;
    public $conversation = null;
    public $freelance_id;
    public $openMessage = false;
    public $messages;
    public $body;
    public $modalC;
    public $confirmModal;
    public $modalStatus;
    public $status;
    public $projetEncours;


    public function mount($mission_numero)
    {

        $exist = MissionResponse::where('response_numero', $mission_numero)

            ->where('status','approved')
            ->exists();


          if($exist){

            $this->response = MissionResponse::where('response_numero', $mission_numero)

                ->where('status', 'approved')
                ->first();


            $this->projet = Mission::where('id', $this->response->mission->id)
            ->where('user_id',auth()->id())

            ->first();



            if(empty($this->projet)){

                session()->flash('error', 'Route inexistante');
                return $this->redirect(route('MissionUser'));

            }

          }else{
            session()->flash('error', 'Route inexistante');

            return $this->redirect(route('MissionUser'));

          }

    }

    public function openModal()
    {
       // $this->modal = true;
    }




    public function accepterAction(): Action
    {
        try {

            return
            Action::make('accepter')
            ->label('Valider')

            ->requiresConfirmation()
                ->modalHeading('Confirmer la fin de la mission')
                ->modalDescription('Êtes-vous sûr que la mission est terminée et souhaitez-vous débloquer le paiement pour le freelance ? Une fois confirmé, cette action ne pourra pas être annulée.')
                ->modalSubmitActionLabel('Oui, Confirmer')
                ->color('success')
                ->modalIcon('heroicon-o-pencil')
                ->modalIconColor('success')
                ->action( function(){

                    $this->projet->update(['status' => 'completed']);
                    $this->dispatch('notify', ['message' => "Paiement debloquer", 'icon' => 'success',]);
                    $this->dispatch('refresh');
                }

                 );

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }



    public function accept()
    {
        try {
            $this->projetEncours->status = 'finis';
            $this->projetEncours->update();
            $this->modalStatus = false;

            $this->dialog()->success(
                $title = "Status changer",
                $description = "Vous avez debloquer le paimement",
            );
        } catch (\Exception $e) {


            $this->dialog()->error(
                $title = "Error !!!",
                $description = "Une erreur est survenue lors de la validation" . $e->getMessage(),
            );
        }
    }

    public function sendFeedback()
    {

        try{



            $data = $this->response->mission->feedbackmission;
            $data->satisfaction = $this->satisfaction ? $this->satisfaction : 2;
            $data->commentaires = $this->feedback['description'];

            $user = $this->response->freelance->user;
            $data->update();

             //$data->notifyFreelanceProjet($user);
            //$this->modal = false;

            $this->dispatch('close-modal', id: 'evaluer');

            $this->dispatch('notify', ['message' => "Commande Modifer Avec Success", 'icon' => 'success',]);
            $this->dispatch('refresh');
            $this->reset('satisfaction', 'feedback');


        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }







    }



    public function render()
    {
        return view('livewire.user.mission.mission-gestion');
    }
}
