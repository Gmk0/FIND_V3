<?php

namespace App\Livewire\User\User;

use App\Models\UserSetting;
use Filament\Notifications\Notification;
use Livewire\Component;

class NotificationConfig extends Component
{

    public $enablePush = false, $enableEmail = false, $enablePhone = false, $compentencesEdit = false, $enableInvoie = false;
    public $userSetting;


    public function mount()
    {




        $this->userSetting = UserSetting::where('user_id', auth()->user()->id)->first();






        if ($this->userSetting != null) {

            $this->enablePush = $this->userSetting->push_notifications_enabled;
            $this->enableEmail
                = $this->userSetting->email_notifications_enabled;


            $this->enablePhone
                = $this->userSetting->number_notifications_enabled;
            $this->enableInvoie
                = $this->userSetting->send_invoice_enabled;
        }
    }



    public function toogle()
    {

        try {
            if ($this->userSetting != null) {


               // dd($this->enablePush);
                $this->userSetting->push_notifications_enabled = $this->enablePush;
                $this->userSetting->email_notifications_enabled =   $this->enableEmail;
                $this->userSetting->number_notifications_enabled =   $this->enablePhone;
                $this->userSetting->send_invoice_enabled = $this->enableInvoie;

                $auth = auth()->user();

                $auth->update();
                $this->userSetting->update();


                $this->dispatch('notify', ['message' => "Modification a porter avec success", 'icon' => 'success',]);

                $this->dispatch('refresh');
            } else {

                $userSetting = new UserSetting();
                $userSetting->user_id = auth()->user()->id;
                $userSetting->push_notifications_enabled = $this->enablePush;
                $userSetting->email_notifications_enabled = $this->enableEmail;
                $userSetting->number_notifications_enabled = $this->enablePhone;
                $userSetting->send_invoice_enabled = $this->enableInvoie;
                $userSetting->save();



                $auth = auth()->user();

                $auth->update();

                $this->dispatch('notify', ['message' => "Modification a porter avec success", 'icon' => 'success',]);
                $this->dispatch('refresh');
            }

        }catch(\Exception $e){
            dd($e->getMessage());

        }



    }

    public function render()
    {
        return view('livewire.user.user.notification-config');
    }
}
