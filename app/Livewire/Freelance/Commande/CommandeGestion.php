<?php

namespace App\Livewire\Freelance\Commande;

use Livewire\Component;


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
use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]

class CommandeGestion extends Component

implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Order $order;

    public $progress;
    public $jour;
    public $description;
    public $publier;
    public $rapport;

    public $livre =false;
    public $status;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($order_numero)
    {

        $exist = Order::where('order_numero', $order_numero)->exists();
        if (!$exist) {

            return $this->redirect(route('freelance.commande.list'), true);
        }


        $this->order = Order::where('order_numero', $order_numero)->first();


        $this->publier = $this->order->feedback->is_publish ? $this->order->feedback->is_publish : 0;
        $this->progress = $this->order->progress;
        $this->status = $this->order->feedback?->etat;
        $this->jour = $this->order->feedback?->delai_livraison_estimee;



        $this->livre();

        $this->rapportForm->fill();
        $this->gestionForm->fill(['status' => $this->order->feedback?->etat,'jour' => $this->order->feedback?->delai_livraison_estimee,'progress' => $this->order->progress,]);
    }


    public function livre(){

      if($this->order->feedback->etat=="Livré"){

        $this->livre=true;

      }else{
            $this->livre = false;
      }
    }

    public function toogle()
    {

        try{

            $id = $this->order->id;



            $data = FeedbackService::where('order_id', $id)->first();
            $data->is_publish = $this->publier;
            $data->update();


            if($this->publier = true){
                $this->dispatch('notify', ['message' => "Votre commentaire a ete publier", 'icon' => 'success',]);

            }else{

                $this->dispatch('notify', ['message' => "Votre commentaire a ete depublier", 'icon' => 'success',]);
            }


        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "la progression doit pas etre inferieur a l'ancienne progression",
                'icon' => 'error',
                'title' => 'error'
            ]);

        }




    }


    public function modLivre()
    {

       $data= $this->gestionForm->getState();
        if ($this->order->progress > $data['progress']) {

            $this->dispatch('error', [
                'message' => "la progression doit pas etre inferieur a l'ancienne progression",
                'icon' => 'error',
                'title' => 'error'
            ]);
            $this->dispatch('refresh');


        } else {

            $this->gestionForm->validate();
            $dataForm = $this->gestionForm->getState();
            $id = $this->order->id;
            $data = FeedbackService::where('order_id', $id)->first();
            try {

                $data->etat = $dataForm['status'];
                $data->delai_livraison_estimee = $dataForm['jour'];
                $data->update();
                $this->order->progress = $dataForm['progress'];
                $this->order->update();
                $this->dispatch('notify', ['message' => "Commande Modifer Avec Success", 'icon' => 'success',]);
                $this->dispatch('refresh');

                 $data->notifyUser();

                $this->livre();

            } catch (\Exception $e) {
                $this->dispatch('error', [
                    'message' => "une erreur s'est produite". $e->getMessage(),
                    'icon' => 'error',
                    'title' => 'error'
                ]);
            }

            $this->dispatch('refresh');
        }

    }



    public function modifier(){


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


    public function rapportForm(Form $form):Form
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
                    'orderedList',
                    'redo',
                    'strike',
                    'undo',
                ])
            ]);
    }


    public function SendRapport()
    {


        $this->rapportForm->validate();
        try{
            $data = $this->rapportForm->getState();

            $dataSave = [
                'description' =>
                $data['rapport'],
                'order_id' => $this->order->id,

            ];
            $saved = Rapport::create($dataSave);

            $this->rapportForm->fill();

            $this->dispatch('refresh');
            $this->dispatch('notify', ['message' => "Rapport envoyer", 'icon' => 'success',]);


        }catch(Exception $e){

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

        try{

            $data =Rapport::find($id)->delete();
            $this->dispatch('refresh');

        }catch(Exception $e){

        }

    }


    public function render(): View
    {

        return view('livewire.freelance.commande.commande-gestion');
    }
}
