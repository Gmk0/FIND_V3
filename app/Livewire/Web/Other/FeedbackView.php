<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.web-layout')]

#[Title('Feedback')]

class FeedbackView extends Component
{
    public $user;
    public $note;
    public $description;

    public function mount()
    {
        $this->user=[
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email
            ];
    }

    public function sendFeedback()
    {
        try{

            $data = ['message' => $this->description, 'note' => $this->rating ?? 2];
            $userSetting = auth()->user()->userSetting;
            $userSetting->update([
                'feedback_submitted' => true,
                'feedback' => $data,

            ]);


            $this->dispatch(
                'notify',
                [
                    'message' => "Feedback envoyer Merci de votre participation",
                    'icon' => 'success',
                ]
            );

        }catch (\Exception $e) {

            $this->dispatch(
                'notify',
                [
                    'message' => "Erreur survenue". $e->getMessage(),
                    'icon' => 'error',
                ]
            );


        }

    }
    public function render()
    {
        return view('livewire.web.other.feedback-view');
    }
}
