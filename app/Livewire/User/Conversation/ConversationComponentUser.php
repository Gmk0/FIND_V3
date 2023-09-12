<?php

namespace App\Livewire\User\Conversation;

use Livewire\Component;
use App\Models\Freelance;
use App\Models\Conversation;
use App\Models\Message;
use Exception;
use WireUi\Traits\Actions;
use App\Events\MessageSent;
use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.chat-layout')]
#[Title('User converstaion')]


class ConversationComponentUser extends Component
{
    public $conversations;
    public $deleteUserModal;
    public $confirmConversation;

    public $selectedConversation = null;
    public $receiver;
    public $freelance_id;
    public $receiverInstance;
    public $messages;
    public $messages_count;
    public $paginateVar = 10;
    public $height;
    public $auth_id;
    public $query = '';
    public $freelance;





    public function  getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            // "echo-private:chat.{$auth_id},MessageSent" => '$refresh',
            'refresh' => '$refresh',
            'loadConversation',
            'refreshList' => '$refresh',
        ];
    }


    public function mount()
    {



        $this->auth_id = auth()->id();
    }

    public function updatedFreelance()
    {


        if ($this->freelance != null) {

            $data = Conversation::where('freelance_id', $this->freelance)->where('user_id', auth()->user()->id)->first();


            if (empty($data)) {

                try {


                    $conversation = new Conversation();
                    $conversation->freelance_id = $this->freelance;
                    $conversation->last_time_message = now();
                    $conversation->status = 'pending';
                    $conversation->save();



                    $data = Conversation::where('freelance_id', $this->freelance)->where('user_id', auth()->user()->id)->first();

                    $this->chatUserSelected($data, $this->freelance);
                } catch (Exception $e) {
                }
            } else {
                $this->chatUserSelected($data, $this->freelance);
            }
        }
    }
    public function chatUserSelected($id, $receiverId)
    {


        // dd($conversation);
        $this->selectedConversation = Conversation::find($id);
        $this->freelance_id = $this->selectedConversation->freelance_id;


        $this->dispatch( 'loadConversation', $this->selectedConversation, $receiverId)->to(BodyMessage::class);

        $this->dispatch('loadConversation', $this->selectedConversation);
    }


    public function effacerConversation()
    {


        $this->deleteUserModal = true;
    }

    public function cancel()
    {


        $this->notification()->success(

            $title = "vous avez annuler",

        );
    }




    public function BloquerConversation()
    {


        $this->notification()->confirm([
            'title'       => 'etes  vous Sur?',
            'description' => 'etes vous sure de bloquer cette utilisateur ?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, Bloquer ',
                'method' => 'bolquerUser',

            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function bolquerUser()
    {
        $data = $this->selectedConversation->update(['status' => 'finished']);

        $this->notification()->success(

            $title = "Vous avez bloquer l'utilisateur",

        );

        $this->dispatch('refresh');

        $this->dispatch( 'refresh')->to(BodyMessage::class);
    }

    public function deleteConversation()
    {
        //dd($this->selectedConversation);

        try {

            $data = $this->selectedConversation->delete();


            $this->notification()->success(

                $title = "succees",

            );
        } catch (\Exception $e) {
        }


        return redirect()->route('MessageUser');
    }


    public function loadConversation(Conversation $conversation)
    {
        $this->selectedConversation = $conversation;

        Message::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', auth()->user()->id)->update(['is_read' => 1]);
    }


    public function render()

    {


        $this->selectedConversation;
        $this->conversations = Conversation::where('user_id', $this->auth_id)
            ->when($this->query, function ($q) {
                $q->whereHas('freelance', function ($query) {
                    $query->where('nom', 'LIKE', "%" . $this->query . "%")
                        ->orWhere('prenom', 'LIKE', "%" . $this->query . "%");
                });
            })
            ->orderBy('last_time_message', 'DESC')->get();
        return view('livewire.user.conversation.conversation-component-user');
    }
}
