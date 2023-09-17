<?php

namespace App\Livewire\Freelance\Profile;

use App\Models\Freelance;
use App\Models\User;
use App\Models\UserSetting;
use Livewire\Component;

use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Actions\EditAction;
use Filament\Forms\Components\{TextInput, Select};


use Livewire\Attributes\{Layout, Title};
use Illuminate\Database\Eloquent\Model;

use Filament\Actions\Action;

#[Layout('layouts.freelance-layout')]
#[Title('Profile')]


class ProfileFreelance extends Component
implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $enablePush = false, $enableEmail = false, $enablePhone = false, $compentencesEdit = false, $enableInvoie = false;
    public $freelance = [];
    public $user = [];
    public $freelanceArray, $freelanceUpdate, $userUpdate, $userSetting;
    public $selected = ['name' => "", "level" => ""];
    public $langueEdit = false;
    public $keyDiplome = null, $keyCompte = null, $keyLangue = null, $keyCertificat = null, $keyCompetences = null;
    public $descriptionErrorMessage = "Veuillez choisir une element a modifier";

    public $langue = [
        'name' => "",
        'level' => "",
    ];
    public $langueSelected = [
        'name' => "",
        'level' => "",
    ];

    public $competences = [
        'skill' => "",
        'level' => "",
    ];

    public $diplome = [
        'universite' => "",
        'diplome' => "",
        'annee' => "",
    ];
    public $diplomeEdit = false;

    public $certificate = [
        'certificate' => "",
        'delivrer' => "",
        'annee' => "",
    ];

    public $compte = [
        'comptes',
        'lien'
    ];
    public $modalCompte = false;
    public $certificateEdit = false;
    public $compentenceEdit, $comptesEdit = false;
    public $date;




    protected  $listeners = ['refresh' => '$refresh'];



    public function mount()
    {
        $this->freelanceUpdate = Freelance::Find(auth()->user()->freelance->id);



        $this->userUpdate = User::find(auth()->user()->id);
        $this->date = $this->dateAnne();
        $this->userSetting = UserSetting::where('user_id', auth()->user()->id)->first();




        if ($this->userSetting != null) {

            $this->enablePush = $this->userSetting->push_notifications_enabled;
            $this->enableEmail
                = $this->userSetting->email_notifications_enabled;
            $this->enablePhone
                = $this->userSetting->number_notifications_enabled;
            $this->enableInvoie
                = $this->userSetting->send_invoice_enabled;
        }
    }

    public function updateFirts()
    {

        $this->validate([
            'user.name' => 'required|string',
            'user.phone' => 'required|numeric',
            'freelance.nom' => 'required|string',
            'freelance.prenom' => 'required|string',
            'freelance.taux_journalier' => 'required|numeric',
            'freelance.experience' => 'required',
        ]);


        try{
            $this->freelanceUpdate->nom = $this->freelance['nom'];
            $this->freelanceUpdate->prenom = $this->freelance['prenom'];
            $this->freelanceUpdate->taux_journalier = $this->freelance['taux_journalier'];
            $this->freelanceUpdate->experience = $this->freelance['experience'];
            $this->freelanceUpdate->update();

            $this->userUpdate->name = $this->user['name'];
            $this->userUpdate->phone = $this->user['phone'];

            $this->userUpdate->update();

            $this->notifyUser();

            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->notifyError($e->getMessage());


        }


    }


    public function updateLocalisation()
    {

        $this->validate([
            'freelance.localisation.avenue' => 'required|string',
            'freelance.localisation.ville' => 'required|string',
            'freelance.localisation.commune' => 'required|string',
            'freelance.site' => 'required',
        ]);

        try{

            $this->freelanceUpdate->localisation['avenue'] = $this->freelance['localisation']['avenue'];
            $this->freelanceUpdate->localisation['ville'] = $this->freelance['localisation']['ville'];
            $this->freelanceUpdate->localisation['commune'] = $this->freelance['localisation']['commune'];
            $this->freelanceUpdate->site = $this->freelance['site'];
            $this->freelanceUpdate->update();
            $this->notifyUser();
            $this->dispatch('refresh');
        }catch(\Exception $e){

            $this->notifyError($e->getMessage());

        }


    }


    //Langue

    public function modifierLangue()
    {


        $this->validate([
            'langueSelected.name' => 'required',
            'langueSelected.level' => 'required',

        ]);

        try{

            if ($this->keyLangue >= 0) {

                $key = $this->keyLangue;


                $this->freelanceUpdate->langue[$key]['name'] = $this->langueSelected['name'];
                $this->freelanceUpdate->langue[$key]['level'] = $this->langueSelected['level'];
                $this->freelanceUpdate->update();

                $this->reset('langueSelected');
                $this->reset('keyLangue');
                $this->langueEdit = false;

                $this->dispatch('close');
                $this->notifyUser();
            } else {


                $this->dispatch('close');

                $this->notifyError("Veuillez choisire une element a modifier");
            }



            $this->dispatch('refresh');


        }catch(\Exception $e){

            $this->notifyError($e->getMessage());

        }



        // dd($key);

    }

    public function modalLangue(Int $key)
    {
        $this->langueSelected = [
            'name' => $this->freelanceUpdate->langue[$key]['name'],
            'level' => $this->freelanceUpdate->langue[$key]['level'],
        ];

        $this->keyLangue = $key;
        $this->langueEdit = true;

        $this->dispatch('openlangue');
    }



    public function addLanguage()
    {



        $this->validate([
            'langueSelected.name' => 'required',
            'langueSelected.level' => 'required',

        ]);

            try {

                $data = $this->freelanceUpdate->langue;
                $data[] = $this->langueSelected;
                $this->freelanceUpdate->langue = $data;
                $this->freelanceUpdate->update();

                $this->dispatch('close');

                $this->reset('langueSelected');

                $this->dispatch('refresh');
                $this->notifyUser();
                    }catch(\Exception $e){

                        $this->notifyError($e->getMessage());
                    }

    }

    public function addDiplome()
    {




        $this->validate([
            'diplome.universite' => "required",
            'diplome.diplome' => "required",
            'diplome.annee' => "required",

        ]);


        try{
            $data = $this->freelanceUpdate->diplome;
            $data[] = $this->diplome;
            $this->freelanceUpdate->diplome = $data;
            $this->freelanceUpdate->update();

            $this->dispatch('close');

            $this->notifyUser();

            $this->reset('diplome');

            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->notifyError($e->getMessage());

        }



    }

    public function addCertificate()
    {



        if (!empty($this->certificate['delivrer']) && !empty($this->certificate['annee'])) {


             try{

                $data = $this->freelanceUpdate->certificat;
                $data[] = $this->certificate;
                $this->freelanceUpdate->certificat = $data;
                $this->freelanceUpdate->update();

                $this->dispatch('close');

                $this->reset('certificate');

                $this->notifyUser();
                $this->dispatch('refresh');

        }catch (\Exception $e){
                $this->notifyError($e->getMessage());

        }



        } else {
            $this->notifyError("Veuillez remplir tout les champs");
        }
    }

    public function remove($key, string $langue)
    {


        switch ($langue) {
            case 'Langue':


                $data = $this->freelanceUpdate->langue->toArray();



                unset($data[$key]);
                $data = array_values($data);
                $this->freelanceUpdate->langue = $data;
                $this->freelanceUpdate->update();
                $this->dispatch('refresh');

                  $this->notifyUser();



                //unset($this->selectedLanguages[$key]);
                //$this->selectedLanguages = array_values($this->selectedLanguages);

                break;
            case 'universite':

                $data = $this->freelanceUpdate->diplome->toArray();

                unset($data[$key]);
                $data = array_values($data);
                $this->freelanceUpdate->diplome = $data;
                $this->freelanceUpdate->update();
                $this->dispatch('refresh');

                  $this->notifyUser();

                  break;
            case 'certificate':

                $data = $this->freelanceUpdate->certificat->toArray();

                unset($data[$key]);
                $data = array_values($data);
                $this->freelanceUpdate->certificat = $data;
                $this->freelanceUpdate->update();
                $this->dispatch('refresh');

                  $this->notifyUser();

            case 'skill':

                $data = $this->freelanceUpdate->competences->toArray();

                unset($data[$key]);
                $data = array_values($data);
                $this->freelanceUpdate->competences = $data;
                $this->freelanceUpdate->update();
                $this->dispatch('refresh');

                  $this->notifyUser();                break;
            case 'Comptes':

                $data = $this->freelanceUpdate->comptes->toArray();

                unset($data[$key]);
                $data = array_values($data);
                $this->freelanceUpdate->Comptes = $data;
                $this->freelanceUpdate->update();
                $this->dispatch('refresh');

                  $this->notifyUser();
                 break;
        }
    }

    //Diplome
    public function modifierDiplome()
    {


        $this->validate([
            'diplome.diplome' => 'required|string',
            'diplome.universite' => 'required|string',
            'diplome.annee' => 'required|numeric',

        ]);



        try{

            if ($this->keyDiplome >= 0) {

                $key = $this->keyDiplome;
                $this->freelanceUpdate->diplome[$key]['diplome'] = $this->diplome['diplome'];
                $this->freelanceUpdate->diplome[$key]['universite'] = $this->diplome['universite'];

                $this->freelanceUpdate->diplome[$key]['annee'] = $this->diplome['annee'];
                $this->freelanceUpdate->update();

                $this->diplomeEdit = false;
                $this->keyDiplome = null;
                $this->dispatch('close');

                $this->notifyUser();
            } else {

                $this->diplomeEdit = false;
                $this->keyDiplome = null;


                $this->dispatch('close');



                $this->notifyError("Veuillez choisire une element a modifier");
            }




            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->notifyError($e->getMessage());

        }



    }

    public function modalDiplome($key)
    {

        $this->diplome['diplome'] = $this->freelanceUpdate->diplome[$key]['diplome'];
        $this->diplome['universite'] = $this->freelanceUpdate->diplome[$key]['universite'];
        $this->diplome['annee'] = $this->freelanceUpdate->diplome[$key]['annee'];
        $this->keyDiplome = $key;
        $this->diplomeEdit = true;
        $this->dispatch('opendiplome');
    }



    //Certificate

    public function modifierCertificate()
    {

        $this->validate([
            'certificate.certificate' => 'required|string',
            'certificate.delivrer' => 'required|string',
            'certificate.annee' => 'required|numeric',

        ]);


        if ($this->keyCertificat >= 0) {

            $key = $this->keyCertificat;
            $this->freelanceUpdate->certificat[$key]['certificate'] = $this->certificate['certificate'];
            $this->freelanceUpdate->certificat[$key]['delivrer'] = $this->certificate['delivrer'];
            $this->freelanceUpdate->certificat[$key]['annee'] = $this->certificate['annee'];
            $this->freelanceUpdate->update();

            $this->resetAll();


            $this->dispatch('close');
            $this->success();
        } else {

            $this->error();
        }

        $this->dispatch('refresh');
    }

    public function modalCertificate($key)
    {
        $this->certificate['certificate'] = $this->freelanceUpdate->certificat[$key]['certificate'];
        $this->certificate['delivrer'] = $this->freelanceUpdate->certificat[$key]['delivrer'];

        $this->certificate['annee'] = $this->freelanceUpdate->certificat[$key]['annee'];


        $this->keyCertificat = $key;
        $this->certificateEdit = true;
        $this->dispatch('opencerti');
    }

    //Compentencess
    public function modaleCompentences($key)
    {

        $this->competences = [
            'skill' => $this->freelanceUpdate->competences[$key]['skill'],
            'level' => $this->freelanceUpdate->competences[$key]['level'],
        ];
        $this->keyCompetences = $key;
        $this->compentenceEdit = true;
        $this->dispatch('openskill');
    }
    public function modifierCompentences()
    {

        $this->validate([
            'competences.skill' => 'required|string',
            'competences.level' => 'required|string',


        ]);

        if ($this->keyCompetences >= 0) {

            try{
                $key = $this->keyCompetences;

                $this->freelanceUpdate->competences[$key]['skill'] = $this->competences['skill'];
                $this->freelanceUpdate->competences[$key]['level'] = $this->competences['level'];

                $this->freelanceUpdate->update();

                $this->resetAll();
                $this->dispatch('close');
                $this->notifyUser();

            }catch(\Exception $e){
                $this->notifyError($e->getMessage());

            }


        } else {
            $this->notifyError("veuillez remplir tout les champs");
        }



        $this->dispatch('refresh');
    }

    public function addCompetences()
    {



        if (!empty($this->competences['skill']) && !empty($this->competences['level'])) {

            try{

                $data = $this->freelanceUpdate->competences;
                $data[] = $this->competences;
                $this->freelanceUpdate->competences = $data;
                $this->freelanceUpdate->update();

                $this->dispatch('close');

                $this->reset('competences');

                $this->dispatch('refresh');
                $this->notifyUser();
            }catch(\Exception $e){
                $this->notifyError($e->getMessage());

            }



        } else {
            $this->notifyError("veuillez remplir tous le champs");
        }




    }

    //comptes

    public function  modifierCompte()
    {

        $this->validate([
            'compte.comptes' => 'required',
            'compte.lien' => 'required',
        ]);


        if ($this->keyCompte >= 0) {

            try{
                $key = $this->keyCompte;
                $this->freelanceUpdate->comptes[$key]['comptes'] = $this->compte['comptes'];
                $this->freelanceUpdate->comptes[$key]['lien'] = $this->compte['lien'];

                $this->freelanceUpdate->update();
                $this->resetAll();
                $this->comptesEdit=false;
                $this->dispatch('close');
                $this->notifyUser();
                $this->dispatch('refresh');

            }catch(\Exception $e){
                $this->notifyError($e->getMessage());

            }


        } else {

            $this->notifyError("veuillez choisir un element");
        }
    }

    public function modalComptes(int $key)
    {
        $this->compte = [
            'comptes' => $this->freelanceUpdate->comptes[$key]['comptes'],
            'lien' => $this->freelanceUpdate->comptes[$key]['lien'],
        ];

        $this->keyCompte = $key;
        $this->comptesEdit = true;
        $this->dispatch('opencompte');
    }

    public function addComptes()
    {
        $this->validate([
            'compte.comptes' => 'required',
            'compte.lien' => 'required',

        ]);

        try{
            $data = $this->freelanceUpdate->comptes;
            $data[] = $this->compte;
            $this->freelanceUpdate->comptes = $data;
            $this->freelanceUpdate->update();

            $this->dispatch('close');

            $this->reset('compte');
            $this->notifyUser();

            $this->dispatch('refresh');


        }catch(\Exception $e){

            $this->notifyError($e->getMessage());

        }



    }


    function error()
    {

        return
            $this->notification()->error(
                $title = "Erreur",
                $description = $this->descriptionErrorMessage,
            );
    }

    public function resetAll()
    {


        $this->reset('compte');
        $this->reset('competences');
        $this->reset('certificate');
        $this->reset('diplome');
        $this->reset('langueSelected');
        $this->reset('keyLangue');
        $this->reset('keyDiplome');
        $this->reset('keyCompte');
        $this->reset('keyCertificat', 'compentenceEdit');

    }



    public function dateAnne()
    {

        $date = [];

        for ($i = 2001; $i < 2023; $i++) {
            # code...
            $date[] = $i;
        };
        return $date;
    }

    public function toogle()
    {
        if ($this->userSetting != null) {
            $this->userSetting->push_notifications_enabled
                =   $this->enablePush;
            $this->userSetting->email_notifications_enabled =   $this->enableEmail;
            $this->userSetting->number_notifications_enabled =   $this->enablePhone;
            $this->userSetting->send_invoice_enabled =   $this->enableInvoie;

            $auth = auth()->user();

            $auth->update();
            $this->userSetting->update();

            $this->notification()->success(
                $title = "Vos modifications ont éte bien sauvergader",

            );
            $this->dispatch('refresh');
        } else {

            $userSetting = new UserSetting();
            $userSetting->user_id = auth()->user()->id;
            $userSetting->push_notifications_enabled = $this->enablePush;
            $userSetting->email_notifications_enabled = $this->enableEmail;
            $userSetting->number_notifications_enabled = $this->enablePhone;
            $userSetting->send_invoice_enabled = $this->enableInvoie;
            $userSetting->save();

            $auth = auth()->user();

            $auth->update();

            $this->notification()->success(
                $title = "Vos modifications ont éte bien sauvergader",

            );
            $this->dispatch('refresh');
        }
    }

    public function notifyUser()
    {
        return
        $this->dispatch('notify', ['message' => "Modification a porter avec success", 'icon' => 'success',]);
    }

    public function notifyError($message)
    {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $message,
                'icon' => 'error',
                'title' => 'error'
            ]);
    }








    Public function updateDescription()
    {
        $this->validate(['freelance.description' => ['required', 'min:150']]);

        try{



            $this->freelanceUpdate->description = $this->freelance['description'];

            $this->freelanceUpdate->update();
            $this->notifyUser();
            $this->dispatch('refresh');

        }catch(\Exception $e){
            $this->notifyError($e->getMessage());

        }
    }

    public function render()
    {
        $this->user = User::find(auth()->user()->id)->toArray();


        $this->freelanceArray = Freelance::find(auth()->user()->freelance->id);
        $this->freelance =
        $this->freelanceArray->toArray();



        return view('livewire.freelance.profile.profile-freelance');
    }
}
