<?php

namespace App\Livewire\Freelance\Other;

use App\Models\FeedbackService;
use App\Models\Message;
use App\Models\Order;
use Livewire\Component;

class PanelSlide extends Component
{

    public $order;
    public $pending, $enAttente, $total, $livre,        $soldeFreelance;



    public function mount()
    {

        $this->soldeFreelance = auth()->user()->freelance->getSolde();
        $this->pendingCommande();
    }

    function pendingCommande()
    {
        $freelance = auth()->user()->freelance->id;

        $order = FeedbackService::query();

        $this->pending = Order::whereHas('service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->where('status', 'en attente')->count();

        $this->enAttente = FeedbackService::whereHas('Order.service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->where('etat', 'En attente de traitement')->count();

        $this->livre = FeedbackService::whereHas('Order.service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->where('etat', 'Livré')->count();

        $this->total = Order::whereHas('service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->count();


        $this->order = FeedbackService::whereHas('Order.service', function ($query) use ($freelance) {
            $query->where('freelance_id', $freelance);
        })->where('etat', 'En attente de traitement')->latest()->take(4)->get();
    }

    public function render()
    {
        return view('livewire.freelance.other.panel-slide',
        ['pending' => $this->pendingCommande(),
        'messages'=>Message::where('receiver_id', auth()->id())->where('is_read',false)->latest()->take(3)->get(),
        ]);
    }
}
