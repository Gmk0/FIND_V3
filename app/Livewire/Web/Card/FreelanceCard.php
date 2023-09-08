<?php

namespace App\Livewire\Web\Card;

use App\Models\Conversation;
use App\Models\Favorite;
use App\Models\Freelance;
use Livewire\Component;

class FreelanceCard extends Component
{
    public Freelance $freelance;

    public function toogleFavorite($freelance)
    {

        $favorite = favorite::where('user_id', auth()->id())
            ->where('freelance_id', $freelance)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'freelance_id' => $freelance,
            ]);
        }

        $this->dispatch('refreshFavorite');
    }

    public function conversation($id)
    {

        if (!auth()->check()) {

            return redirect('/login');
        }



        try {


            $freelance = Freelance::find($id);

            $conversation = Conversation::where('freelance_id', $freelance->id)
                ->whereHas('user', function ($query) {
                    $query->where('id', auth()->id());
                })
                ->first();




            // Si une conversation est trouvée, afficher la vue de la conversation
            if ($conversation === null) {
                // return redirect()->route('MessageUser');



                $conversation = new Conversation();
                $conversation->freelance_id = $freelance->id;
                $conversation->last_time_message = now();
                $conversation->status = 'pending';
                $conversation->save();
            }
            // $this->emitTo('user.conversation.body-message', 'loadConversation', $conversation, $freelance->id);


            return redirect()->route('MessageUser');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error', ['message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.web.card.freelance-card');
    }
}
