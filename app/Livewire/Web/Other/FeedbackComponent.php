<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;

class FeedbackComponent extends Component
{
    public $showFeedback = false;
    public $feedbackSubmitted = false;
    public $description;
    public $rating = 0;

    public function mount()
    {


        // attendez 10 minutes





        $this->showFeedback = !auth()->user()->userSetting->feedback_submitted;


    }

    public function sendFeedback()
    {


        $this->validate(['description'=>'required',]);

        try{
            $data = ['satisfaction' => $this->description, 'note' => $this->rating ?? 2];
            $userSetting = auth()->user()->userSetting;
            $userSetting->update([
                'feedback_submitted' => true,
                'feedback' => $data,
            ]);
            $this->feedbackSubmitted = true;
            $this->showFeedback = false;

            $this->dispatch(
                'notify',
                [
                    'message' => "Feedback envoyer Merci",
                    'icon' => 'success',
                ]
            );



        }catch(\Exception $e){

            $this->dispatch(
                'notify',
                [
                    'message' => "Error survenue",
                    'icon' => 'danger',
                ]
            );
        }


    }
    public function render()
    {
        return view('livewire.web.other.feedback-component');
    }
}
