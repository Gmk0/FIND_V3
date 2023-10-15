<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use App\Models\{Transaction,Commission};
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

use Livewire\Attributes\On;
use Livewire\Attributes\{Layout, Title};
use Illuminate\Database\Eloquent\Model;

use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.user-layout')]

#[Title('Mission Edit')]

class MissionGestion extends Component

implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;
    public $response;
    public $projet;
   public $paidFreealance = false;
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
    //public $projetEncours;


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



                    $this->dispatch('accept');
                }

                 );

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }


    #[On('accept')]

    public function accept()
    {
        $this->paidFreealance = true;

        DB::beginTransaction();
        try {

            $date= now();

            $this->projet->update([
                'is_paid' => $date,
                'status' => 'completed',

                ]);
            $this->response->update(['is_paid' =>$date]);


            $freelance = $this->response->freelance;

            // Calculer 70% du montant total de la commande
            $amountToAdd = $this->response->budget * 0.70;
            $commissionAmount = $this->response->budget * 0.30;

            $freelance->solde += $amountToAdd;
            $freelance->save();

            // 30% de commission

            $transaction = Transaction::create([
                'user_id' => $freelance->user_id,
                'type' => 'debit',
                'amount' => $amountToAdd,
                'description' => 'Débit pour la mission #' . $this->projet->order_numero . ' après déduction de la commission',
                'status' => 'completed'

            ]);
            $commission = new Commission();
            $commission->mission_id = $this->projet->id;
            $commission->amount = $commissionAmount;
            $commission->user_id = $freelance->user_id;
            $commission->net_amount = $amountToAdd;
            $commission->percent = '30%';
            $commission->description = 'Commission de 30% prélevée sur le projet.';
            $commission->transaction_id = $transaction->id;
            $commission->save();



            DB::commit();



            $this->paidFreealance = false;

            $this->dispatch('notify', ['message' => "Confirmation reussie", 'icon' => 'success',]);


            $this->dispatch('notifier');
        } catch (\Exception $e) {



            $this->paidFreealance = false;
            DB::rollback();
            $this->dispatch('error', [
                'message' => "Une errer s'est produite lors de la confirmation du paiement" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
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
