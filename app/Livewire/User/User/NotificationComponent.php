<?php

namespace App\Livewire\User\User;

use Livewire\Component;
use App\Models\Notification;
//use App\Events\ProjectResponse;
//use WireUi\Traits\Actions;
use App\Events\ProgressOrderEvent;
use App\Events\OrderCreated;

//use App\Events\MessageSent;

use WireUi\Traits\Actions;

class NotificationComponent extends Component
{
    use Actions;
    public $notifications;


    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            //"echo-private:notify.{$auth_id},ProgressOrderEvent" => '$refresh',
            "echo-private:notify.{$auth_id},ProgressOrderEvent" => 'Notify',
            "echo-private:notify.{$auth_id},OrderCreated" => 'NotifyFreelance',
            //"echo-private:notify.{$auth_id},ProjectResponse" => '$refresh',
            //'ServiceOrdered' => '$refresh',
            //"echo-private:chat.{$auth_id},MessageSent" => '$refresh',
            'refreshComponent' => '$refresh',
            'refreshNotifications' => '$refresh',


        ];
    }

    public function Notify(){
        $this->notification()->info(
            $title = "Information",
            $description = "vous a recu des modifications de votre commande",
        );

        $this->dispatch('refreshNotifications');


    }
    public function NotifyFreelance()
    {

        $this->dispatch('notify', ['message' => "Vous recu une notification", 'icon' => 'info',]);


        $this->dispatch('refreshNotifications');
    }

    public function markRead($id)
    {



        $notification = Notification::find($id);

        $notification->read_at = now();

        $notification->update();

        return redirect($notification->data['url']);


        //$this->emit('refreshNotifications');
    }

    public function markReads()
    {

        try{

            if (!empty($this->notifications)) {
                foreach ($this->notifications as $notification) {
                    $notification->markAsRead();
                }


            }

            $this->dispatch('refreshNotifications');
            $this->dispatch('notify', ['message' => "Commande Modifer Avec Success", 'icon' => 'success',]);

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
        $this->notifications = auth()->user()->unreadNotifications()->latest()->get();

        return view('livewire.user.user.notification-component', [
            'notification' => auth()->user()->unreadNotifications()->latest()->take(8)->get(),
            'count'=>Notification::where('notifiable_id', '=', auth()->id())->where('is_read','=', null)->count(),
            'commande' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\OrderNotification")->latest()->take(8)->get(),
            'Progress' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\ProgressOrder")->Where('type', '=', "App\Notifications\progressProjet")->orWhere('type', '=', " App\Notifications\feedbackNotification")->latest()->take(8)->get(),
            'tabEvents' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\OrderNotification")->orWhere('type', '=', "App\Notifications\orderUser")->latest()->take(8)->get(),
        ]);
    }
}
