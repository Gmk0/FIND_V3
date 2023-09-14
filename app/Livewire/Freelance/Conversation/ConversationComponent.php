<?php

namespace App\Livewire\Freelance\Conversation;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.chat-layout')]
#[Title('Freelance converstaion')]

class ConversationComponent extends Component
{
    public $conversations;

    public $selectedConversation;
    public $receiver;
    public $receiverInstance;
    public $freelancerId;
    public $user_id;
    public $query;



    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [

            "echo-private:chat.{$auth_id},MessageSent" => '$refresh',

            'chatUserSelected',
            'refresh' => '$refresh',
            'refreshUser' => '$refresh',
            'refreshList' => '$refresh',
            'changeChat'=>'$refresh',



        ];
    }


    public function sendEvent()
    {

    }


    public function mount()
    {

        $this->freelancerId = auth()->user()->freelance->id;
    }



    public function render()
    {

        $this->conversations = Conversation::where('freelance_id', $this->freelancerId)->orderBy('last_time_message', 'DESC')->get();

        $this->conversations = Conversation::where('freelance_id', $this->freelancerId)
            ->when($this->query, function ($q) {
                $q->whereHas('user', function ($query) {
                    $query->where('name', 'LIKE', "%" . $this->query . "%");
                });
            })
            ->orderBy('last_time_message', 'DESC')->get();
        return view('livewire.freelance.conversation.conversation-component');
    }
}
