<?php

namespace App\Livewire\User\Mission;

use App\Models\Category;
use App\Models\Mission;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\{TextInput, RichEditor};
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\{Layout, Title};


#[Layout('layouts.user-layout')]

#[Title('Mission Edit')]
class MissionEdit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Mission $record;

    public $files =null;

    protected $listeners=['refresh'=>'$refresh'];

    public function mount($mission_numero)
    {


        $exist = Mission::where('mission_numero', $mission_numero)
            ->where('user_id', auth()->id())->exists();



        if ($exist) {

            $this->record = Mission::where('mission_numero', $mission_numero)
                ->where('user_id', auth()->id())->first();


            $this->imageForm->fill();
            $this->editForm->fill($this->record->attributesToArray());
        } else {
            return $this->redirect(route('MissionUser'));
        }

    }

    public function editForm(Form $form): Form
    {
        return $form
            ->schema([
            //

            Section::make()->schema([
                Textarea::make('title')
                    ->minLength(2)
                    ->maxLength(1024)
                    ->required(),
                Textarea::make('description')
                    ->minLength(2)
                    ->maxLength(1024)->required(),


                     RichEditor::make('exigences')->label('Exigences Pour la mission'),


                Select::make('category_id')->label('categorie')
                    ->options(Category::query()->pluck('name', 'id'))
                    ->searchable()
                    ->native(false),


                Grid::make(['md' => 2])->schema([

                    DatePicker::make('begin_mission')
                        ->minDate(now())
                        ->native(false),
                    DatePicker::make('end_mission')
                        ->minDate(now())
                        ->native(false),
                ]),
                TextInput::make('budget')->label('Taux journalier')
                    ->numeric()
                    ->prefix('$')
                    ->inputMode('decimal')
                    ->required(),


                ]),

                       ])
            ->statePath('data')
            ->model($this->record);
    }

    public function imageForm(Form $form) :Form
    {
        return $form->schema([

            FileUpload::make('files')
                ->multiple()
                ->preserveFilenames()
                ->directory('mission')
                ->imagePreviewHeight('100')
                ->required(),

        ]);
    }

    protected function getForms(): array
    {
        return [
            'editForm',
            'imageForm',


        ];
    }


    public function save(): void
    {
        $data = $this->editForm->getState();

        $this->record->update($data);
        $this->dispatch('notify', [
            'message' => "Mission Modifier avec success",
            'icon' => 'success',
        ]);
    }


    public function Modifier()
    {

        $this->imageForm->validate();
        $fileName = $this->imageForm->getState();

        $data = $this->record->files;
        foreach ($fileName['files'] as $file) {
            $data[] = $file;
        }




        $this->record->files = $data;
        $this->record->update();

        $this->dispatch('notify', [
            'message' => "Mission Modifier avec success",
            'icon' => 'success',
        ]);

        $this->reset('files');

        $this->imageForm->fill();


        $this->dispatch('refresh');
    }


    public function effacerImage($key)
    {
        try{




        $file = $this->record->files[$key];
        $data = $this->record->files;
        unset($data[$key]);
        $data = array_values($data);
        $datal = Storage::disk('local')->exists('public/' . $file);
        if ($datal) {
            Storage::disk('local')->delete('public/' . $file);
            $this->record->files = $data;
            $this->record->update();
                $this->dispatch('notify', [
                    'message' => "Mission Modifier avec success",
                    'icon' => 'success',
                ]);

            $this->dispatch('refresh');
        } else {

            $this->record->files = $data;
            $this->record->update();

            $this->dispatch('error', [
                'message' => "Erreur le fichier est introuvable",
                'icon' => 'error',
                'title' => 'error',
            ]);
        }
    }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Erreur le fichier est introuvable",
                'icon' => 'error',
                'title' => 'error',
            ]);

    }
    }

    public function render(): View
    {
        return view('livewire.user.mission.mission-edit');
    }
}
