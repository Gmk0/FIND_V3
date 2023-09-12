<?php

namespace App\Livewire\Freelance\Mission;

use App\Models\FeedbackService;
use App\Models\Mission;
use App\Models\MissionResponse;
use App\Models\Rapport;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Illuminate\Contracts\View\View;

use Filament\Forms\Get;
use Filament\Tables\Actions\{BulkAction, Action};
use Illuminate\Support\Collection;

use Filament\Forms\Components\{DateTimePicker, TextInput, RichEditor, DatePicker, MarkdownEditor, Select, Toggle, FileUpload, Section};
use Filament\Notifications\Notification;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Mission')]

class MissionWork extends Component

implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public MissionResponse $projetResponse;
    public Mission $projet;
    public $description;
    public $publier;
    public $projetUpdate;
    public $progress;
    public $jour;
    public $rapport;

    public $livre = false;
    public $status;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($mission_numero)
    {


        $existe = $this->existe($mission_numero);

        if(!$existe) {
            session()->flash('error', 'Route inexistante');
            return $this->redirect(route('freelance.proposition'), true);

        }


        $this->initState();






        $this->rapportForm->fill();
        $this->gestionForm->fill(['status' => $this->projet->feedbackmission->etat, 'jour' => $this->projet->feedbackmission->delai_livraison_estimee, 'progress' => $this->projet->progress,]);





    }


    public function toogle()
    {

        try {

            $id = $this->projet->id;



            $data = FeedbackService::where('mission_id', $id)->first();
            $data->is_publish = $this->publier;
            $data->update();


            if ($this->publier == true) {
                $this->dispatch('notify', ['message' => "Votre commentaire a ete publier", 'icon' => 'success',]);
            } else {

                $this->dispatch('notify', ['message' => "Votre commentaire a ete depublier", 'icon' => 'success',]);
            }
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "la progression doit pas etre inferieur a l'ancienne progression",
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function livre()
    {

        if($this->projet->feedbackmission->etat == "Livré") {

            $this->livre = true;
        } else {
            $this->livre = false;
        }
    }



    public function existe($mission_numero){

        $mission = Mission::where('mission_numero', $mission_numero)->exists();
        if(!$mission)
        {
            return false;
        }

        $this->projet = Mission::where('mission_numero', $mission_numero)->first();

        $existsResponse = MissionResponse::where('mission_id', $this->projet->id)
        ->where('freelance_id', auth()->user()->getIdFreelance())
        ->where('status', 'approved')->exists();



        if (!$existsResponse) {
            return false;
        }


        $this->projetResponse = MissionResponse::where('mission_id', $this->projet->id)
        ->where('freelance_id', auth()->user()->getIdFreelance())
        ->where('status', 'approved')->first();

        return true;


    }
    public function initState()
    {

       // dd($this->projet->feedbackmission);
        $this->publier = $this->projet->feedbackmission->is_publish ? $this->projet->feedbackmission->is_publish : 0;

        $this->status = $this->projet->feedbackmission->etat;

        $this->jour = $this->projet->feedbackmission->delai_livraison_estimee;
        $this->progress = $this->projet->progress;



        if($this->status == "Livré") {
            $this->livre = true;
        } else {
            $this->livre = false;
        }
    }

    public function modLivre()
    {

        $data = $this->gestionForm->getState();


        if ($this->projet->progress > $data['progress']) {

            $this->dispatch('error', [
                'message' => "la progression doit pas etre inferieur a l'ancienne progression",
                'icon' => 'error',
                'title' => 'error'
            ]);
            $this->dispatch('refresh');
        } else {

            $this->gestionForm->validate();
            $dataForm = $this->gestionForm->getState();
            $id = $this->projet->id;
            $data =FeedbackService::where('mission_id', $id)->first();
            try {

                $data->etat = $dataForm['status'];
                $data->delai_livraison_estimee = $dataForm['jour'];
                $data->update();
                $this->projet->progress = $dataForm['progress'];
                $this->projet->update();
                $this->dispatch('notify', ['message' => "Commande Modifer Avec Success", 'icon' => 'success',]);
                $this->dispatch('refresh');

                $data->notifyUserProjet();

                $this->livre();
            } catch (\Exception $e) {
                $this->dispatch('error', [
                    'message' => "une erreur s'est produite" . $e->getMessage(),
                    'icon' => 'error',
                    'title' => 'error'
                ]);
            }

            $this->dispatch('refresh');
        }
    }


    public function modifier()
    {


        $this->livre = false;
    }

    public function gestionForm(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make('3')->schema([
                    Select::make('status')
                    ->options([
                        'En attente de traitement' => 'En attente de traitement',
                        'En cours de préparation' => 'En cours de préparation',
                        'En transit' => 'En transit',
                        'Livré' => 'Livré',
                    ])->native(false),
                    DatePicker::make('jour')->required()->label('Delai de livrasion')->native(false),
                    Select::make('progress')
                    ->options([
                        0 => '0 %', '20' => '20 %', '30' => '30 %', '40' => '40 %', '50' => '50 %', '60' => '60 %', '70' => '70 %', '80' => '80 %', '90' => '90 %', '100' => '100 %',
                    ])->live(),
                ]),


            ])
            ->statePath('data');
    }


    public function rapportForm(Form $form): Form
    {
        return $form->schema([

            RichEditor::make('rapport')
            ->fileAttachmentsDirectory('attachments')
            ->toolbarButtons([
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'projetedList',
                'redo',
                'strike',
                'undo',
            ])
        ]);
    }


    public function SendRapport()
    {


        $this->rapportForm->validate();
        try {
            $data = $this->rapportForm->getState();

            $dataSave = [
                'description' =>
                $data['rapport'],
                'mission_id' => $this->projet->id,

            ];
            $saved = Rapport::create($dataSave);

            $this->rapportForm->fill();

            $this->dispatch('refresh');
            $this->dispatch('notify', ['message' => "Rapport envoyer", 'icon' => 'success',]);
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }


    protected function getForms(): array
    {
        return [
            'gestionForm',
            'rapportForm',

        ];
    }

    public function effacerRapport($id)
    {

        try {

            $data = Rapport::find($id)->delete();
            $this->dispatch('refresh');
        } catch (\Exception $e) {
        }
    }


    public function render()
    {
        return view('livewire.freelance.mission.mission-work');
    }
}
