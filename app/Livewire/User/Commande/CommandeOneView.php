<?php

namespace App\Livewire\User\Commande;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.user-layout')]

#[Title('Commande')]
class CommandeOneView extends Component
{
    public Order $order;
    public $order_id;
    public $modal = false;
    public $feedback;
    public $satisfaction = 0;
    public $conversation = null;
    public $freelance_id;
    public $openMessage = false;
    public $messages;
    public $body;
    public $modalC;
    public $confirmModal;
    public $userId;
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
    public function render()
    {
        return view('livewire.user.commande.commande-one-view');
    }
}
