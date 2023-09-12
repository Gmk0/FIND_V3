<?php

namespace App\Livewire\User\Other;

use App\Models\Transaction;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.user-layout')]

#[Title('Status')]
class CheckoutStatusMission extends Component
{
    public $transaction;

    public function mount($transaction_numero){

        $this->transaction =Transaction::where('transaction_numero',$transaction_numero)->first();

        if(empty($this->transaction))
        {
            session()->flash('error', 'Route inexistante');
            return $this->redirect(route('MissionUser'));
        }

    }
    public function render()
    {
        return view('livewire.user.other.checkout-status-mission');
    }
}
