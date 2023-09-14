<?php

namespace App\Livewire\User\User;

use Livewire\Component;
use App\Models\Notification;
//use App\Events\ProjectResponse;
//use WireUi\Traits\Actions;
//use App\Events\ProgressOrderEvent;
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
            "echo-private:notify.{$auth_id},ProgressOrderEvent" => '$refresh',
            "echo-private:notify.{$auth_id},ProgressOrderEvent" => 'Notify',
            "echo-private:notify.{$auth_id},OrderCreated" => '$refresh',
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
        if (!empty($this->notifications)) {
            foreach ($this->notifications as $notification) {
                $notification->markAsRead();
            }

            return redirect()->back();
        }
    }


    public function render()
    {
        $this->notifications = auth()->user()->unreadNotifications()->latest()->get();
        return view('livewire.user.user.notification-component', [
            'notification' => auth()->user()->unreadNotifications()->latest()->take(8)->get(),
            'commande' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\OrderNotification")->latest()->take(8)->get(),
            'Progress' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\ProgressOrder")->Where('type', '=', "App\Notifications\progressProjet")->orWhere('type', '=', " App\Notifications\feedbackNotification")->latest()->take(8)->get(),
            'tabEvents' => auth()->user()->unreadNotifications()->where('type', '=', "App\Notifications\OrderNotification")->orWhere('type', '=', "App\Notifications\orderUser")->latest()->take(8)->get(),
        ]);
    }
}
