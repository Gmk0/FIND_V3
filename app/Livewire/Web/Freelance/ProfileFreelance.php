<?php

namespace App\Livewire\Web\Freelance;

use App\Models\FeedbackService;
use App\Models\Freelance;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};


#[Layout('layouts.web-layout')]

#[Title('Freelance')]
class ProfileFreelance extends Component
{
    public Freelance $freelance;

    public $description = '';
    public $commentaires;
    public $commandeE;
    public $commandeEn;


    public function mount($identifiant){

        $exist= Freelance::where('identifiant',$identifiant)->exists();


        if ($exist) {

            $this->freelance = Freelance::where('identifiant', $identifiant)->first();




        } else {
           // return $this->redirect(route(''));
        }

    }


    public function commandeEncours()
    {
        $commandeEncours
            = FeedbackService::whereHas('order.service', function ($query) {
                $query->where('freelance_id', $this->freelance->id);
            })->where('etat', '!=', 'Livré')->count();
        return $commandeEncours;
    }
    public function render()
    {
        $subCategories = SubCategory::whereIn('id', $this->freelance->sub_categorie)->get();



        $this->commentaires = FeedbackService::whereHas('order.service', function ($query) {
            $query->where('freelance_id', $this->freelance->id)
                ->where('commentaires', '!=', null)
                ->where('is_publish', true);
        })->get();

        $this->commandeE
            = FeedbackService::whereHas('order.service', function ($query) {
                $query->where('freelance_id', $this->freelance->id);
            })->where('etat', 'Livré')->count();

        $this->commandeEn = $this->commandeEncours();
        return view('livewire.web.freelance.profile-freelance',['subCategories'=> $subCategories]);
    }
}
