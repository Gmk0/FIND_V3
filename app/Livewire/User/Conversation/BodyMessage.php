<?php

namespace App\Livewire\User\Conversation;

use App\Models\Conversation;
use App\Models\{Message, Proposal,ClientLink};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Freelance;

use App\Events\MessageRead;
use App\Events\MessageSent;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\{Card, TextInput, FileUpload};
use Filament\Forms\Components\FormComponent;
use WireUi\Traits\Actions;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;

use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Crypt;



class BodyMessage extends Component

implements Forms\Contracts\HasForms, HasActions
{
    use Actions;


    use WithFileUploads;

    use Forms\Concerns\InteractsWithForms;
    use InteractsWithActions;


    public $selectedConversation = null;
    public $receiver;
    public $receiverInstance;
    public $messagesChat = null;
    public $messages_count;
    public $paginateVar = 10;
    public $height;
    public $usearActive;
    public $body;
    public $createdMessage;
    public $dataC;
    public $files;
    public $document;
    public $messageElement;
    public $confirmModal;
    public $services;
    public $price;
    public $service_id;
public $proposalChanged;



    public function  getListeners()
    {
        try{

            $auth_id = auth()->user()->id;
            return [


                'changeChat' => 'changeChat',
                'changeChatuSER' => 'changeChatuSER',
                "echo-private:chat.{$auth_id},MessageSent" => 'broadcastedMessageReceived',
                "echo-private:chat.{$auth_id},MessageRead" => 'broadcastedMessageRead',
                'loadConversation', 'pushMessage', 'loadmore', 'updateHeight', 'dispatchMessageSent', 'broadcastMessageRead', 'resetComponent'


            ];

        }catch(\Exception $e){



        }


    }


    public function broadcastedMessageRead($event)
    {


        if ($this->selectedConversation) {
            if ((int) $this->selectedConversation['chatId'] === (int) $event['conversation_id']) {
                $this->dispatch('markMessageAsRead');

                $this->dispatch('refreshList');
            }
        }
        # code...
    }


    function broadcastedMessageReceived($event)
    {




        $this->dispatch('refreshList');


        # code...




        $broadcastedMessage = Message::find($event['message']);





        // #check if any selected conversation is set
        if ($this->selectedConversation) {
            // #check if Auth/current selected conversation is same as broadcasted selecetedConversationg
            if ((int) $this->selectedConversation['chatId']  === (int)$event['conversation_id']) {
                // # if true  mark message as read



                $broadcastedMessage->is_read = true;
                $broadcastedMessage->save();


                // $this->pushMessage($broadcastedMessage->id);

                $this->messagesChat->push($broadcastedMessage);

                $this->dispatch('rowChatToBottom');
                $this->dispatch('broadcastMessageRead')->self();
            }
        }
    }


    public function mount()
    {


        $this->fileForm->fill();
        $this->imageForm->fill();
        $this->usearActive = auth()->user()->id;
    }

    public function fileForm(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()
                ->schema([
                    FileUpload::make('document')->label('document')
                    ->required()
                        ->multiple()
                        ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain'])
                        ->preserveFilenames()
                        ->directory('messages')
                        ->maxFiles(3)
                        ->maxSize(5024),
                    // ...

                ])



        ]);
    }
    public function imageForm(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()
                ->schema([
                    FileUpload::make('files')->label('Fichier')
                    ->required()
                        ->image()
                        ->multiple()
                        ->imagePreviewHeight('100')

                        ->preserveFilenames()
                        ->directory('messages')
                        ->maxFiles(3)
                        ->maxSize(5024),
                    // ...

                ])



        ]);
    }


    protected function getForms(): array
    {
        return [
            'fileForm',
            'imageForm',

        ];
    }


    public function getLastActivityDisplay($lastActivity)
    {
        $fiveMinutesAgo = Carbon::now()->subMinutes(5);
        $lastActivityTime = Carbon::parse($lastActivity);




        if ($lastActivityTime->gt($fiveMinutesAgo)) {
            return "En ligne";
        } else {
            return $lastActivityTime->format('H:i');
        }
    }
    public function changeChat($data)
    {

        $this->dataC = Conversation::find($data['id']);

        $this->receiverInstance = $this->dataC->user;
        $this->selectedConversation = [
            'name' => $this->dataC->user->name,
            'chatId' => $this->dataC->id,
            'user_id' => $this->dataC->user->id,
            'freelance_id' => $this->dataC->freelance_id,
            'profile_url' => $this->dataC->user->profile_photo_url,
            'profile_path' => $this->dataC->user->profile_photo_path,
            'last_time' => $this->getLastActivityDisplay($this->dataC->user->last_activity),
        ];


        $this->messages_count = Message::where('conversation_id', $this->selectedConversation['chatId'])->count();
        $this->messagesChat =
            Message::where('conversation_id', $this->selectedConversation['chatId'])
            ->skip($this->messages_count - $this->paginateVar)
            ->take($this->paginateVar)

            ->get();

        $this->dispatch('rowChatToBottom');

        $data= Message::where('conversation_id', $this->selectedConversation['chatId'])
            ->where('receiver_id', auth()->user()->id)->update(['is_read' => true]);

        // dd($data);
        $this->dispatch('broadcastMessageRead')->self();

        $this->messageElement = Message::where('conversation_id', $this->selectedConversation['chatId'])->get();


        $this->dispatch('refreshList');

    }

    public function changeChatuSER($data)
    {

       try{

            $this->dataC = Conversation::find($data['id']);



            $this->receiverInstance = $this->dataC->freelance->user;
            $this->selectedConversation = [
                'name' => $this->dataC->freelance->user->name,
                'chatId' => $this->dataC->id,
                'user_id' => $this->dataC->freelance->user->id,
                'freelance_id' => $this->dataC->freelance_id,
                'profile_url' => $this->dataC->freelance->user->profile_photo_url,
                'profile_path' => $this->dataC->freelance->user->profile_photo_path,
                'last_time' => $this->getLastActivityDisplay($this->dataC->freelance->user->last_activity),
            ];




            $this->messages_count = Message::where('conversation_id', $this->selectedConversation['chatId'])->count();
            $this->messagesChat =
                Message::where('conversation_id', $this->selectedConversation['chatId'])
                ->skip($this->messages_count - $this->paginateVar)
                ->take($this->paginateVar)

                ->get();

            $this->dispatch('rowChatToBottom');

            Message::where('conversation_id', $this->selectedConversation['chatId'])
                ->where('receiver_id', auth()->user()->id)->update(['is_read' => true]);

            $this->dispatch('broadcastMessageRead');

            $this->messageElement = Message::where('conversation_id', $this->selectedConversation['chatId'])->get();
            $this->services = $this->dataC->freelance->services;

       }catch(\Exception $e){

       }
    }

    public function SendMessageFile()
    {

        $this->imageForm->validate();

        $file = $this->imageForm->getState();

        $this->dispatch('close');




        try {




            $this->createdMessage = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $this->selectedConversation['user_id'],
                'conversation_id' => $this->selectedConversation['chatId'],
                'body' => $this->body ?? null,
                'file' => $file['files'],
                'is_read' => false,
                'type' => "file",

            ]);

            $this->messagesChat->push($this->createdMessage);
            $this->dispatch('close');
            $this->dispatch('rowChatToBottom');
            $this->imageForm->fill();

            $this->dispatch('refreshList');
            $this->dispatch('dispatchMessageSent')->self();

            //$this->messageElement->push($this->createdMessage);
        } catch (\Exception $e) {
            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function sendMessage()
    {

        $this->validate(['body' => 'required',]);

        try {


            $this->createdMessage = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $this->selectedConversation['user_id'],
                'conversation_id' => $this->selectedConversation['chatId'],
                'body' => $this->body,
                'is_read' => false,
                'type' => "text",

            ]);

            $this->messagesChat->push($this->createdMessage);
            $this->reset('body');
            $this->dispatch('rowChatToBottom');
            $this->dispatch('refreshList');
            $this->dispatch('dispatchMessageSent')->self();
            // $this->dispatchMessageSent();
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }




        // $this->messages->push($message);
    }

    public function dispatchMessageSent()
    {


        try {
            broadcast(new MessageSent(auth()->user(), $this->createdMessage, $this->dataC, $this->receiverInstance));
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function SendMessageDoc()
    {

        $this->fileForm->validate();

        $file = $this->fileForm->getState();



        $this->dispatch('close');


        try {





            $this->createdMessage = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $this->selectedConversation['user_id'],
                'conversation_id' => $this->selectedConversation['chatId'],
                'body' => $this->body ?? $this->body,
                'file' => $file['document'],
                'is_read' => false,
                'type' => "doc",

            ]);

            $this->messagesChat->push($this->createdMessage);

            $this->dispatch('rowChatToBottom');
            $this->fileForm->fill();

            $this->dispatch('refreshList');
            $this->dispatchSelf('dispatchMessageSent');

            $this->messageElement->push($this->createdMessage);
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }


    public function resetFile()
    {

        $this->fileForm->fill();
        $this->imageForm->fill();
    }


    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatch('rowChatToBottom');
        # code...
    }


    public function broadcastMessageRead()
    {

        try {
            broadcast(new MessageRead($this->selectedConversation['chatId'], $this->receiverInstance->id));
            # code...
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    function loadmore()
    {


        sleep(2);

        try {


            $this->paginateVar = $this->paginateVar + 10;
            $this->messages_count = Message::where('conversation_id', $this->selectedConversation['chatId'])->count();

            $this->messagesChat = Message::where('conversation_id', $this->selectedConversation['chatId'])
                ->skip($this->messages_count -  $this->paginateVar)
                ->take($this->paginateVar)
                ->get();

            $height = $this->height;
            $this->dispatch('updatedHeight', ($height));
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
        # code...
    }


    /*---------------------------------------------------------------------*/
    /*------------------Update height of messageBody-----------------------*/
    /*---------------------------------------------------------------------*/
    function updateHeight($height)
    {


        $this->height = $height;

        # code...
    }


    public function deleteMessage($id)
    {
        //dd($id);

        $newMessage = Message::find($id)->delete();
        //$this->messages->destroy($newMessage);
        $this->dispatch('rowChatToBottom');
        $this->dispatchSelf('refresh');
        $this->dispatchTo('user.conversation.conversation-component', 'refresh');
    }

    public function blockUser()
    {
    }

    public function EffacerMessage()
    {

        $this->notification()->info(
            $title = 'information',
            $description = "",
        );
    }

    public function muteChat()
    {
    }

    public function Propososal($service_id){

        $this->service_id = $service_id;


        $this->dispatch('open-modal', id: 'proposer-price');
    }

    public function refuserProposal($id)
    {

        try{
            $proposal = Proposal::find($id);
            $proposal->status = 'rejected';
            $proposal->update();
            $this->createdMessage= Message::create(
                [
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $this->selectedConversation['user_id'],
                    'conversation_id' => $this->selectedConversation['chatId'],
                    'body' => 'Proposition de '. $proposal->proposed_price .'$ refuser',
                    'proposal_id' => $proposal->id,
                    'is_read' => false,
                    'type' => "text",
                    ]

            );
            $this->messagesChat->push($this->createdMessage);
            $this->reset('body');
            $this->dispatch('rowChatToBottom');
            $this->dispatchUser();


        }catch(\Exception $e)
        {
            dd($e->getMessage());

        }



    }

     public function editActionE($id)
     {
        $this->proposalChanged= Proposal::find($id);

        $this->price = $this->proposalChanged->proposed_price;

        $this->dispatch('open-modal', id: 'changer-price');


     }


    public function accepterAction(): Action
    {
        try {

            return
                Action::make('accepter')
            ->label('valider')
            ->outlined()
            ->requiresConfirmation()
            ->modalHeading('Confirmation de la Proposition de Prix')
            ->modalDescription('Confirmez-vous la soumission de cette proposition de prix pour votre service d ? Une fois confirmée, le client sera notifié et un lien de paiement sera généré pour qu\'il puisse procéder au paiement si cette proposition est acceptée.')

            ->modalSubmitActionLabel('Oui, Accepter')

                ->color('success')
                ->modalIcon('heroicon-o-pencil')
                ->modalIconColor('success')
                ->action(function (array $arguments) {
                $propasal = Proposal::find($arguments['proposal_id']);

                $uniqueId = \Ramsey\Uuid\Uuid::uuid4()->toString();

                $propasal->status = "accepted";
                $propasal->save();
                $clientLink = new ClientLink();
                $clientLink->user_id = $this->selectedConversation['user_id']; // ID du client
                $clientLink->uniqueId = $uniqueId;
                $clientLink->proposal_id = $propasal->id;
                $clientLink->save();

                $lien = route('customLink.paid', ['uniqueId' => $uniqueId]);

                $this->sendLink($lien);



                });
        } catch (\Exception $e) {

            //dd($e->getMessage());
        }
    }

    public function sendLink($link)
    {
        try{


            $this->createdMessage = Message::create(
                [
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $this->selectedConversation['user_id'],
                    'conversation_id' => $this->selectedConversation['chatId'],
                    'body' => 'Veuillez procéder au paiement en utilisant ce lien : <a class="px-4 text-lg text-blue-600" href="' . $link . '">Paiement</a>',
                   // 'proposal_id' => $this->proposalChanged->id,
                    'is_read' => false,
                    'type' => "text",
                ]
            );



            $this->messagesChat->push($this->createdMessage);
            $this->reset('body');
            $this->dispatch('rowChatToBottom');
            $this->dispatchUser();

        }catch (\Exception $e){
            dd($e->getMessage());

        }

    }



    public function changePrice()
    {
        $this->validate(['price' =>'required|numeric']);

    try {

            $this->proposalChanged->status = 'pending';
            $this->proposalChanged->proposed_price=$this->price;
            $this->proposalChanged->update();
            $this->createdMessage = Message::create(
                [
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $this->selectedConversation['user_id'],
                    'conversation_id' => $this->selectedConversation['chatId'],
                    'body' => "Je propose un prix de <span class='px-4 font-bold'>$" . $this->price . "</span>. pour ce service !",
                    'proposal_id' => $this->proposalChanged->id,
                    'is_read' => false,
                    'type' => "text",
                ]
            );
            $this->dispatch('close-modal', id: 'changer-price');
            $this->messagesChat->push($this->createdMessage);
            $this->reset('body');
            $this->dispatchUser();
        }catch(\Exception $e){

            dd($e->getMessage());

        }

    }




    public function PropososalPrice(){

        $this->validate(['price' => 'required']);


        try{

            $propososal = new Proposal();
            $propososal->proposed_price=$this->price;
            $propososal->service_id=$this->service_id;
            $propososal->freelance_id= $this->dataC->freelance_id;
            $propososal->save();

            $messagesChat = New Message();
            $body = "Je propose un prix de <span class='px-4 font-bold'>$" . $this->price . "</span>. pour ce service !";

            $this->dispatch('close-modal', id: 'proposer-price');

            $this->createdMessage=$messagesChat->createWithProposal($propososal, Auth::user()->id, $this->selectedConversation['user_id'], $body ,$this->selectedConversation['chatId']);

            $this->messagesChat->push($this->createdMessage);
            $this->reset('body');
            $this->dispatchUser();

        }catch(\Exception $e){
            dd($e->getMessage());

        }



    }
    public function dispatchUser()
    {
        $this->dispatch('rowChatToBottom');
        $this->dispatch('refreshList');
        $this->dispatch('dispatchMessageSent')->self();
    }


    public function render()
    {

        return view('livewire.user.conversation.body-message');
    }
}
