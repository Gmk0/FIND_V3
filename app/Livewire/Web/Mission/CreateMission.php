<?php

namespace App\Livewire\Web\Mission;

use Livewire\Component;

use App\Models\Category;
use App\Models\Mission;
use App\Models\Project;

use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\{TextInput, Textarea, DatePicker};
use Livewire\Attributes\Layout;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\Title;

#[Layout('layouts.web-layout')]

#[Title('Creer missiion')]

class CreateMission extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;
    public $fichier = null;
    public $mission = ['title' => '', 'description' => '', 'category' => '', 'tax' => '', 'begin' => '', 'end' => ''];



    public function mount()
    {

        $this->missionForm->fill();
    }



    public function  missionForm(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Detail Mission')
                    ->description('Decrivez votre mission')
                    ->schema([
                        Textarea::make('mission.title')
                            ->minLength(2)
                            ->maxLength(1024)
                            ->required(),
                        Textarea::make('mission.description')
                            ->minLength(2)
                            ->maxLength(1024)->required(),

                        FileUpload::make('fichier')
                            ->multiple()
                            ->preserveFilenames()
                            ->directory('mission')
                            ->imagePreviewHeight('100')
                            ->required(),

                        Select::make('mission.category')->label('categorie')
                            ->options(Category::query()->pluck('name', 'id'))
                            ->searchable()
                            ->native(false),




                        // ...
                    ]),
                Wizard\Step::make('Echance & Budget')
                    ->schema([

                        Grid::make(['md' => 2])->schema([

                            DatePicker::make('mission.begin')
                                ->minDate(now())
                                ->native(false),
                            DatePicker::make('mission.end')
                                ->minDate(now())
                                ->native(false),
                        ]),
                        TextInput::make('mission.tax')->label('Taux journalier')
                            ->numeric()
                            ->prefix('$')
                            ->inputMode('decimal')
                            ->required(),
                        // ...
                    ]),

            ])->submitAction(new HtmlString(Blade::render(<<<BLADE
    <x-filament::button
        type="submit"
        size="sm"
    >
        Submit
    </x-filament::button>
BLADE))),


        ]);
    }


    public function register()
    {
        $this->missionForm->validate();

        $data = $this->missionForm->getState();


        try {

            $projet = Mission::create([
                'title' => $data['mission']['title'],
                'category_id' => $data['mission']['category'],
                'description' => $data['mission']['description'],
                'files' => $data['fichier'],
                'budget' => $data['mission']['tax'],
                'begin_mission' => $data['mission']['begin'],
                'end_mission' => $data['mission']['end'],
                'progress' => 0,


            ]);

            $this->dispatch('notify', [
                'message' => "Mission creer avec success",
                'icon' => 'success',
            ]);

            $this->missionForm->fill();

        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite". $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }
    }

    protected function getForms(): array
    {
        return [
            'missionForm',

        ];
    }


    public function render()
    {

        return view('livewire.web.mission.create-mission');
    }
}
