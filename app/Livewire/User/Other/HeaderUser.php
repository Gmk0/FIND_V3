<?php

namespace App\Livewire\User\Other;

use Livewire\Component;

class HeaderUser extends Component
{


    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [

            "echo-private:notify.{$auth_id},ProgressOrderEvent" => 'sendNotify', //
            //'ServiceOrdered' => '$refresh',
        ];
    }
    public function render()
    {
        return view('livewire.user.other.header-user');
    }
}
