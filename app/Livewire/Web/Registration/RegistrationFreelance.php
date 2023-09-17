<?php

namespace App\Livewire\Web\Registration;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Models\SubCategory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use WireUi\Traits\Actions;
use App\Models\Freelance;
use App\Mail\welcomeFreelance;
use Illuminate\Support\Facades\Mail;

#[Layout('layouts.web-layout')]
class RegistrationFreelance extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public $step = 1;
    public ?array $userAuth = [];
    public $user;

    public $totalStep = 5;
    public $category;
    public $competences = array();
    public $newSkill = ['skill' => '', 'level' => ''];
    public $selectedSkill = array();
    public $experience;
    public $sub_category;
    public $newFreelance = ['name' => '', 'tax' => '', 'prenom' => '', 'description' => '', 'site' => '', 'experience'];
    public $localisation = ['avenue' => "", 'commune' => '', 'ville' => ""];
    public $image = null;
    public $newLanguage = ['language' => '', 'level' => ''];
    public $selectedLanguages = [];
    public $selectedDiplome = [];
    public $selectedComptes = [];
    public $selectedCertificat = [];
    public $newCertificate = ['certificate' => '', 'delivrer' => '', 'annee' => ''];
    public $newComptes = ['comptes' => '', 'lien' => ''];
    public $newDiplome = ['diplome' => '', 'universite' => '', 'annee' => ''];
    public $currency;

    public $annee;





    public function mount()
    {

        $this->imageForm->fill();
        $this->annee = $this->dateAnne();
        $this->addCompteForm->fill();
        $this->langueForm->fill();
        $this->step = 1;

        $this->user = auth()->user();
        $this->userAuth = $this->user->toArray();

        //dd($this->userAuth);
    }


    public function validateData()
    {
        switch ($this->step) {
            case 1:
                $this->validate([
                    'currency' => "required",
                    "localisation" => "required",
                    'category' => 'required',
                    "sub_category" => 'required',


                ]);


                $this->addSkill();


                break;
            case 2:
                $this->validate([
                    'newFreelance.name' => "required",
                    "newFreelance.prenom" => "required",
                    "newFreelance.description" => "required|min:150",
                ]);
                //$this->imageForm->validate();
                $this->addLanguage();


                break;

            case 3:


                $this->addCertificate();
                $this->addDiplome();


                break;
            case 4:




                // $this->dispatchBrowserEvent('stepChanged');
                break;
        }
    }

    public function editPostForm(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([

                    'sm' => 1,
                    'md' => 2,

                ])->schema([
                    Select::make('category')
                    ->label('categorie')
                    ->options(Category::query()->pluck('name', 'id'))
                        ->live()
                        ->searchable()
                        ->native(false),

                ]),

                Grid::make([
                    'sm' => 1,
                    'md' => 2,
                ])->schema([
                    Select::make('sub_category')->label('Sous categorie')
                    ->options(fn (Get $get): Collection => SubCategory::query()
                        ->where('category_id', $get('category'))
                        ->pluck('name', 'id'))
                        ->visible(fn (Get $get): bool => filled($get('category')))
                        ->multiple()
                        ->searchable()
                    ->maxItems(4)
                        ->native(false),

                    Select::make('experience')
                    ->options([
                        '0-2 ans' => '0-2 ans',
                        '2-7 ans' => '2-7 ans',
                        '+ 7 ans' => '+ 7 ans',
                    ])->visible(fn (Get $get): bool => filled($get('category')))
                        ->native(false)

                ]),



                // ...
            ]);
    }


    public function skillForm(Form $form): Form
    {
        return $form->schema([
            Grid::make(['md' => 2])
                ->schema([
                    TextInput::make('newSkill.skill')->required(),
                    Select::make('newSkill.level')
                    ->options([
                        'Debutant' => 'Debutant',
                        'Intermédiaire' => 'Intermédiaire',
                        'expert' => 'expert',
                    ])->native(false),


                ]),



        ]);
    }

    public function addCompteForm(Form $form): Form
    {
        return $form->schema([
            Grid::make(['md' => 2])
                ->schema([

                    Select::make('newComptes.comptes')
                    ->options([
                        'Facebook' => 'Facebook',

                        'Twitter' => 'Twitter',
                        'Youtube' => 'Youtube',
                        'Tiktok' => 'Tiktok',

                    ])->native(false),
                    TextInput::make('newComptes.lien'),


                ]),



        ]);
    }


    public function imageForm(Form $form): Form
    {
        return $form->schema([
            Grid::make(['md' => 2])
                ->schema([
                    FileUpload::make('image')->label('image')

                    ->imagePreviewHeight('100')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1')
                    ->panelLayout('integrated')
                    ->directory('profile-photos')
                    ->preserveFilenames()
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->image()
                    ->imageEditor()




                ]),



        ]);
    }
    public function addSkill()
    {


        if (!empty($this->newSkill['skill']) && !empty($this->newSkill['level'])) {
            // Add the new language to the selectedLanguages list
            array_push($this->selectedSkill, ['skill' => $this->newSkill['skill'], 'level' => $this->newSkill['level']]);


            $this->newSkill = ['skill' => '', 'level' => ''];
        }

        // Emit an event to inform that a new language has been added

    }

    public function langueForm(Form $form): Form
    {
        return $form->schema([
            Grid::make(['md' => 2])
                ->schema([
                    Select::make('newLanguage.language')
                    ->options([
                        'Français' => 'Français',
                        'Anglais' => 'Anglais',
                        'Lingala' => 'Lingala',
                        'Swahili' => 'Swahili',
                        'Kikongo' => 'Kikongo',
                        'Tshiluba' => 'Tshiluba',

                    ])->native(false),


                    Select::make('newLanguage.level')
                    ->options([
                        'Debutant' => 'Debutant',
                        'Intermédiaire' => 'Intermédiaire',
                        'expert' => 'expert',
                    ])->native(false),
                ]),
        ]);
    }
    public function addLanguage()
    {
        if (!empty($this->newLanguage['language']) && !empty($this->newLanguage['level'])) {
            // Add the new language to the selectedLanguages list
            $this->selectedLanguages[] = ['name' => $this->newLanguage['language'], 'level' => $this->newLanguage['level']];


            $this->newLanguage = ['language' => '', 'level' => ''];

            // Emit an event to inform that a new language has been added

        }
    }

    public function addComptes()
    {
        $this->addCompteForm->validate();

        if (!empty($this->newComptes['comptes']) && !empty($this->newComptes['lien'])) {


            $this->selectedComptes[] = ['comptes' => $this->newComptes['comptes'], 'lien' => $this->newComptes['lien']];
            $this->newComptes = ['comptes' => '', 'lien' => ''];
        }

        // Emit an event to inform that a new language has been added

    }
    public function addCertificate()
    {


        if (!empty($this->newCertificate['certificate']) && !empty($this->newCertificate['delivrer']) && !empty($this->newCertificate['annee'])) {
            // Add the new certificate to the selectedcertificate list
            $this->selectedCertificat[] = ['certificate' => $this->newCertificate['certificate'], 'delivrer' => $this->newCertificate['delivrer'], 'annee' => $this->newCertificate['annee']];

            $this->newCertificate = ['certificate' => '', 'delivrer' => '', 'annee' => ''];
        }
        // Emit an event to inform that a new language has been added


    }

    public function addDiplome()
    {

        if (!empty($this->newDiplome['diplome']) && !empty($this->newDiplome['universite']) && !empty($this->newDiplome['annee'])) {

            // Add the new diplome to the selectedDiplome list
            $this->selectedDiplome[] = ['diplome' => $this->newDiplome['diplome'], 'universite' => $this->newDiplome['universite'], 'annee' => $this->newDiplome['annee']];

            $this->newDiplome = ['diplome' => '', 'universite' => '', 'annee' => ''];

            // Emit an event to inform that a new language has been added
        }
    }

    public function removeLanguage($index, $select)
    {
        switch ($select) {
            case 'langue':
                unset($this->selectedLanguages[$index]);
                $this->selectedLanguages = array_values($this->selectedLanguages);
                break;
            case 'universite':
                unset($this->selectedDiplome[$index]);
                $this->selectedDiplome = array_values($this->selectedDiplome);
                break;
            case 'certificate':
                unset($this->selectedCertificat[$index]);
                $this->selectedCertificat = array_values($this->selectedCertificat);

                break;
            case 'skill':
                unset($this->selectedSkill[$index]);
                $this->selectedSkill = array_values($this->selectedSkill);
                break;
        }
    }

    public function dateAnne()
    {

        $date = [];

        for ($i = 1990; $i <= date('Y'); $i++) {
            # code...
            $date[] = $i;
        };
        return $date;
    }


    public function increaseStep()
    {
        $this->validateData();
        $this->resetErrorBag();
        $this->step++;

        if ($this->step >   $this->totalStep) {
            $this->step = $this->totalstep;
        }

        //Wont reach here if the Validation Fails.
        $this->dispatch('stepChanged');
    }
    public function decreaseStep()
    {
        $this->step--;
        $this->resetErrorBag();

        if ($this->step < 1) {
            $this->step = 1;
        }
        $this->dispatchBrowserEvent('stepChanged');
    }


    protected function getForms(): array
    {
        return [
            'editPostForm',
            'skillForm',

            'imageForm',
            'langueForm',
            'addCompteForm'
        ];
    }

    public function register()
    {

        $this->validate([
            "userAuth.email" => "required",
            //"userAuth.phone" => "required|numeric|integer",
        ]);



        try {


            if (empty($this->selectedLanguages) || empty($this->selectedSkill)  || empty($this->sub_category)) {



                $this->dispatch('error', [
                    'message' => "Veuillez Remplir tout les champs",
                    'icon' => 'error',
                    'title' => 'error'
                ]);

            } else {

                DB::beginTransaction();

                $this->addImage();

                $data = [
                    'nom' => $this->newFreelance['name'],
                    'prenom' => $this->newFreelance['prenom'],
                    'description' => $this->newFreelance['description'],
                    'langue' => $this->selectedLanguages,
                    'diplome' => $this->selectedDiplome,
                    'certificat' => $this->selectedCertificat,
                    'site' => $this->newFreelance['site'],
                    'experience' => $this->experience,
                    'competences' => $this->selectedSkill,
                    'taux_journalier' => $this->currency,
                    'comptes' => $this->selectedComptes,
                    'sub_categorie' => $this->sub_category,
                    'localisation' => $this->localisation,
                    'category_id' => $this->category,
                    'level' => 1
                ];





                Freelance::create($data);

                Db::commit();

                $this->dispatch('sendMail');
                // dd($data);

                $this->step = 1;
                //$this->resetAll();
                Session::flash('success', 'Bienvenue Freelance');


                Db::commit();

                return redirect()->intended('freelance/dashboard');

            };
        } catch (\Exception $e) {

            DB::rollBack();
            $this->dispatch('error', [
                'message' => "Une erreur s'est produite". $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);

        }
    }




      #[On('sendMail')]
    public function sendMail()
    {
        try {
            Mail::to(auth()->user()->email)->send(new welcomeFreelance(auth()->user()));
        } catch (\Exception $e) {

            error_log($e->getMessage());
        }

    }

    function addImage()
    {
        $fileNames = $this->imageForm->getState();




        if (!empty($fileNames['image'])) {


            $this->user->profile_photo_path = $fileNames['image'];
            $this->user->update();
        }
    }

    public function render()
    {
        return view('livewire.web.registration.registration-freelance');
    }
}
