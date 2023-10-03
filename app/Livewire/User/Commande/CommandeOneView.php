<?php

namespace App\Livewire\User\Commande;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use App\Events\ProgressOrderEvent;
use App\Models\Conversation;
use App\Models\Message;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\On;

use Filament\Actions\EditAction;
use Filament\Forms\Components\{TextInput, Select};
use WireUi\Traits\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use App\Models\Commission;
use App\Models\Transaction;

#[Layout('layouts.user-layout')]

#[Title('Commande')]
class CommandeOneView extends Component

implements HasForms, HasActions
{
    use Actions;

    use InteractsWithActions;
    use InteractsWithForms;
    public Order $order;
    public $order_id;
    public $modal = false;
    public $feedback=['description'=>''];
    public $description;
    public $satisfaction = 0;
    public $conversation = null;
    public $freelance_id;
    public $openMessage = false;
    public $messages;
    public $body;
    public $modalC;
    public $confirmModal;
    public $userId;

    public $messageSent=false;
    public $paidFreealance = false;




    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            "echo-private:notify.{$auth_id},ProgressOrderEvent" => '$refresh',
            //"echo-private:notify.{$auth_id},ProgressOrderEvent" => 'sendNotify', //
            //'ServiceOrdered' => '$refresh',
        ];
    }
    public function mount($order_number)
    {

        $exist = Order::where('order_numero', $order_number)->exists();

        if ($exist) {

            $this->order = Order::where('order_numero', $order_number)->first();
            $this->order_id = $this->order->id;





            $this->freelance_id = $this->order->service->freelance->id;
            $this->userId = $this->order->service->freelance->user->id;
        } else {

            session()->flash('error', 'Route inexistante');
            return $this->redirectRoute('commandeUser');
        }
    }



    public function sendFeedback()
    {

        try {



            $data = $this->order->feedback;
            $data->satisfaction = $this->satisfaction ? $this->satisfaction : 2;
            $data->commentaires = $this->feedback['description'];

            $user = $this->order->service->freelance->user;
            $data->update();


            //$this->modal = false;
            $this->dispatch('sendNotification')->self();

            $this->dispatch('close-modal', id: 'evaluer');

            $this->dispatch('notify', ['message' => "Feedback envoyer Avec Success", 'icon' => 'success',]);
            $this->dispatch('refresh');
            $this->reset('satisfaction', 'feedback');
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }


    #[On('sendNotification')]
    public function sendNotification(){
        try{
            $data = $this->order->feedback;

            $user = $this->order->service->freelance->user;
            $data->notifyFreelanceProjet($user);

        }catch(\Exception $e){

            $this->dispatch('notify', ['message' => "Erreur survenue", 'icon' => 'error',]);
        }
    }


    public function contacter()
    {


        try {


            $conversation = Conversation::where('freelance_id',$this->freelance_id)
                ->whereHas('user', function ($query) {
                    $query->where('id', auth()->id());
                })
                ->first();



            if (!$conversation) {
                $conversation = new Conversation();
                $conversation->freelance_id
                = $this->freelance_id;
                $conversation->last_time_message = now();
                $conversation->status = 'pending';
                $conversation->save();
            }

            $createdMessage = Message::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $this->userId,
                'conversation_id' => $conversation->id,
                'body' => $this->body,
                'is_read' => "0",
                'type' => "text",
                'order_id' => $this->order->id,

            ]);

            $this->reset('body');

            $this->messageSent=true;



            $this->dispatch('notify', ['message' => "Message envoyer avec success", 'icon' => 'success',]);
        } catch (\Exception $e) {


            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function sendNotify()
    {

        $this->notification()->info(
            $title="Information",
            $description="vous a recu des modifications de votre commande",
        );
        //$this->dispatch('notify', ['message' => "Modification a porter a votre commande", 'icon' => 'success',]);

    }

    #[On('impossible')]
    public function impossible()
    {

        $this->dispatch('error', [
            'message' => "Impossible d'annuler cette commande le freelance a deja atteint une progression de plus de 60%",
            'icon' => 'error',
            'title' => 'error'
        ]);

    }

    #[On('paid')]
    public function paid(){

        $this->paidFreealance = true;

        DB::beginTransaction();
        try{


            $this->order->is_paid = now();
            $this->order->update();


            $freelance = $this->order->service->freelance;

            // Calculer 70% du montant total de la commande
            $amountToAdd = $this->order->total_amount * 0.70;
            $commissionAmount = $this->order->total_amount * 0.30;

            $freelance->solde += $amountToAdd;
            $freelance->save();

            // 30% de commission

            $transaction =Transaction::create([
                'user_id' => $freelance->user_id,
                'type' => 'debiter',
                'amount' => $amountToAdd,
                'description' => 'Débit pour la commande #' . $this->order->order_numero . ' après déduction de la commission',
                'status'=>'completed'

            ]);
            $commission = new Commission();
            $commission->order_id = $this->order->id;
            $commission->amount = $commissionAmount;
            $commission->user_id = $freelance->user_id;
            $commission->net_amount = $amountToAdd;
            $commission->percent = '30%';
            $commission->description = 'Commission de 30% prélevée sur la commande.';
            $commission->transaction_id = $transaction->id;
            $commission->save();



            DB::commit();



            $this->paidFreealance = false;

            $this->dispatch('notify', ['message' => "Confirmation reussie", 'icon' => 'success',]);


            $this->dispatch('notifier');



        }catch(\Exception $e){



                DB::rollback();
            $this->dispatch('error', [
                'message' => "Une errer s'est produite lors de la confirmation du paiement". $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }

    }

    #[On('notifier')]
    public function notifier()
    {
        try{

            $this->order->notifyPaid();

            $this->order->brodacastFreelance();

        }catch(\Exception $e){

            dd($e->getMessage());
        }
    }

    public function annulerAction(): Action
    {
        return Action::make('annuler')
        ->label('Annuler la commande')
        ->requiresConfirmation()
            ->modalHeading('Annuler la commande')
            ->modalDescription('Êtes-vous sûr de vouloir Annuler la commande? Depasser le 60% la commande peut plus etre annuler.')
            ->modalSubmitActionLabel('Oui, Annuler')
            ->color('danger')
            ->modalIcon('heroicon-o-pencil')
            ->modalIconColor('danger')
            ->action(function (array $arguments) {
                $order = Order::find($arguments['id']);

                if($order->progress > 60)
                {
                    $this->dispatch('impossible');

                }else{

                    dd('annuler');

                }



            });
    }

    public function confirmAction(): Action
    {
        return Action::make('confirm')
        ->label('Confirmer Comannde Finis')
        ->requiresConfirmation()
            ->modalHeading('Confirmez la réception de votre commande')
            ->modalDescription('En confirmant la réception, vous attestez que la commande a été réalisée à votre satisfaction. Cela permettra au freelance de recevoir son paiement. Êtes-vous prêt à procéder?')
            ->modalSubmitActionLabel('Oui, je confirme')

            ->color('success')

            ->modalIconColor('success')
            ->action(function (array $arguments) {
                $order = Order::find($arguments['id']);


                    $this->dispatch('paid');

            });
    }


    public function render()
    {
        return view('livewire.user.commande.commande-one-view');
    }
}
