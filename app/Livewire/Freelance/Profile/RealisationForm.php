<?php

namespace App\Livewire\Freelance\Profile;

use App\Models\Freelance;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

use Livewire\Attributes\{Layout, Title};
use Illuminate\Database\Eloquent\Model;

use Filament\Forms\Components\{TextInput, RichEditor, FileUpload, Grid, MarkdownEditor, Section, Textarea};


use Filament\Actions\Action;

#[Layout('layouts.freelance-layout')]
#[Title('Profile')]

class RealisationForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Freelance $record;
    public $freelanceUpdate;
    public $editForm=false;
    public $key;
    public $description;
    public $image;

    public function mount(): void
    {


        $this->record = auth()->user()->freelance;

        $this->freelanceUpdate
        = $this->record->toArray();


        $this->form->fill();


    }

    public function resetAll()
    {
        $this->reset('editForm','key');
        $this->form->fill();
    }

    public function editReal($key)
    {



           $data = $this->record->realisations[$key]['image'];
        $this->form->fill([

            'description' => $this->record->realisations[$key]['description'],
        ]);

        $this->editForm=true;
        $this->key=$key;

       $this->dispatch('open-modal',  id: 'realisation' );


    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(['md' => 1])->schema([

                    FileUpload::make('image')
                    ->imagePreviewHeight('100')
                    ->image()
                    ->imageEditor()
                    ->directory('realisations')
                    ->multiple(),
                Textarea::make('description')


                    ])





                //
            ])

        ;
    }

    public function save()
    {
        $this->form->validate();

        $data = $this->form->getState();
        try{

            $element = $this->record->realisations;
            $element[] =$data;

            $this->record->update(['realisations' => $element]);

            $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);


            $this->form->fill();

            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);

        }


    }

    public function editRealisation()
    {
        $this->form->validate();
        $data = $this->form->getState();

        try {



            $element = $this->record->realisations[$this->key];
            $data = $this->form->getState();

            // Fusionner les images des deux tableaux
            $mergedImages = array_merge($element['image'], $data['image']);

            // Mettre à jour la description avec celle de $data
            $mergedDescription = $data['description'];

            // Créer le tableau final
            $mergedArray = [
                'image' => $mergedImages,
                'description' => $mergedDescription
            ];


            $this->record->realisations[$this->key] = $mergedArray;


            $this->record->update();



            $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);


            $this->form->fill();

            $this->dispatch('refresh');
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    public function render(): View
    {
        return view('livewire.freelance.profile.realisation-form');
    }
}
