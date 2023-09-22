<?php

namespace App\Livewire\Freelance\Mission;

use App\Models\Mission;
use App\Models\MissionResponse;
use App\Models\FeedbackService;
use App\Models\Order;
use App\Models\Rapport;
use Exception;
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
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use Livewire\Component;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]
class MissionProposition extends Component
implements HasForms
{

    use InteractsWithForms;
    public Mission $projet;
    public $proposition;
    public $proposition_id;
    public $description;
    public $isOpen;

    public $content;
    public $amount;
    public $modal = false;
    public $modalEdit = false;
    public $response = null;
    public $delai;


    protected $listeners = ['refresh' => '$refresh'];
    public function mount($mission_numero){

        $exist = Mission::where('mission_numero', $mission_numero)->where('status','pending')->exists();

        if(!$exist){

            session()->flash('error', 'Route inexistante');

            return $this->redirect(route('freelance.projet.list'));

        }

        $this->propositionForm->fill();
        $this->projet= Mission::where('mission_numero', $mission_numero)->where('status', 'pending')->first();

        $this->response = MissionResponse::where('mission_id', $this->projet->id)->where('freelance_id', auth()->user()->getIdFreelance())->first();

        if($this->response != null){
            $this->modalEdit = true;

        }


    }


    public function openModal()
    {


        $this->dispatch('openpost');
    }

    public function fermer()
    {

        $this->modal = false;
    }

    public function sendResponse()
    {


        $this->propositionForm->validate();

        $data =
        $this->propositionForm->getState();



        try {

            if (empty($this->response)) {

                $$this->response = MissionResponse::create([
                    'mission_id' => $this->projet->id,
                    'freelance_id' => auth()->user()->getIdFreelance(),
                    'content' => $data['description'],
                    'budget' => $this->amount ?? $this->projet->budget,
                ]);

                $this->response->notifyUser();


            }
            $this->dispatch('notify', ['message' => "Votre message a ete envoyer avec success", 'icon' => 'success',]);




            $this->modalEdit = true;

            $this->propositionForm->fill();

            $this->reset( 'amount');



            $this->dispatch('openpost');

            $this->dispatch('refresh');
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite ". $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function openModalEdit()
    {




        $this->amount = $this->response->budget;

        $this->modalEdit=true;

        $this->propositionForm->fill(['description'=> $this->response->content]);
        $this->isOpen=true;
        $this->dispatch('openpost');


        $this->dispatch('openprice');



    }


    public function editResponse()
    {



        $this->propositionForm->validate();

        $data =
            $this->propositionForm->getState();

        try {

            if (!empty($this->response)) {


                $this->response->content =$data['description'];
                $this->response->budget = $this->amount ? $this->amount : $this->projet->budget;

                $this->response->update();

                $this->response->notifyUser();

            }


            $this->dispatch('notify', ['message' => "Votre message a ete modifier avec success", 'icon' => 'success',]);


            $this->dispatch('openpost');

            $this->dispatch('refresh');
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite " . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);


        }
    }

    public function propositionForm(Form $form) :Form
    {
        return $form->schema([

            RichEditor::make('description')
            ->toolbarButtons([
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'undo',
            ])
            ->required()

        ]);
    }


    protected function getForms(): array
    {
        return [
            'propositionForm',


        ];
    }



    public function render()
    {
        return view('livewire.freelance.mission.mission-proposition');
    }
}
