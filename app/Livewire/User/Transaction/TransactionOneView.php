<?php

namespace App\Livewire\User\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;


use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.user-layout')]

#[Title('Transaction')]
class TransactionOneView extends Component implements HasForms, HasInfolists
{

      use InteractsWithInfolists;
    use InteractsWithForms;
    public Transaction $transaction;


    public function mount($transaction_number)
    {



        $exist = Transaction::where('transaction_numero', $transaction_number)
            ->where('user_id', auth()->id())->exists();


        if ($exist) {

            $this->transaction =
                Transaction::where('transaction_numero', $transaction_number)
                ->where('user_id', auth()->id())->first();
        } else {
            return $this->redirect(route('transactionUser'));
        }
    }


    public function render()
    {
        return view('livewire.user.transaction.transaction-one-view');
    }
}
