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

        sleep(2);
        // attendez 10 minutes




        // Vérifiez si l'utilisateur a déjà soumis un feedback
        $this->feedbackSubmitted = auth()->user()->userSetting->feedback_submitted;
        //sleep(2);




        if (!$this->feedbackSubmitted) {
            // Si non, affichez la section de feedback après 10 minutes
            sleep(60);
            // attendez 10 minutes

         $this->showFeedback = true;
        }
    }

    public function sendFeedback()
    {
        // Traitez le feedback ici (par exemple, enregistrez-le dans la base de données)

        // Marquez que l'utilisateur a soumis un feedback



        $this->validate(['description'=>'required',]);

        try{
            $data = ['satisfaction' => $this->description, 'note' => $this->rating ?? 2];
            $userSetting = auth()->user()->userSetting;



            $userSetting->update([
                'feedback_submitted' => true,
                'feedback' => $data,
                ''
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
