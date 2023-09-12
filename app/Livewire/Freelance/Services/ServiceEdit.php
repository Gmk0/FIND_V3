<?php

namespace App\Livewire\Freelance\Services;

use App\Models\Service;
use App\Models\SubCategory;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Storage;

use Filament\Forms\Components\{TextInput, RichEditor, MarkdownEditor, Select, Toggle, FileUpload, Section};

use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Get;
use Illuminate\Support\Collection;


use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

use Livewire\Attributes\{Layout, Title};


#[Layout('layouts.freelance-layout')]
#[Title('Modification Service')]
class ServiceEdit extends Component implements HasForms
{
    use InteractsWithForms;

    protected $listeners = ['refresh' => '$refresh'];
    public $files;

    public ?array $data = [];

    public Service $record;

    public function mount($service_numero)
    {
        $exist = Service::where('service_numero', $service_numero)->exists();

        if (!$exist) {

            return $this->redirect(route('freelance.service.list'));
        }

        $this->record
            = Service::where('service_numero', $service_numero)->first();

        $this->editForm->fill($this->record->attributesToArray());
        $this->imageForm->fill();
    }

    public function imageForm(Form $form): Form
    {
        return $form->schema([

            Grid::make('2')->schema([
                FileUpload::make('files')->label('Image Decrivant le service')
                    ->multiple()
                    ->maxFiles(2)
                    ->imageEditorMode(2)
                    ->directory('service')
                    ->imagePreviewHeight('100')

                    ->image()
                    ->required()
                    ->imageEditor(),

            ]),
        ]);
    }

    public function editForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Service')
                    ->schema([
                        // ...


                        Fieldset::make('titre')->schema([
                            TextInput::make('title')->label('Titre')->helperText('Donner un titre a votre service ')->required(), Forms\Components\TagsInput::make('tag')->helperText('le tag pour faciliter la recherche ')->suggestions([
                                'tailwindcss',
                                'alpinejs',
                                'laravel',
                                'livewire',
                                'photographie',
                            ])->placeholder('laravel , React js, vue js'),

                        ]),


                        //TextInput::make('title')->label('Titre')->placeholder('Je vais photographier votre mariage civil'),

                        Fieldset::make('Sous categories')
                            ->schema([
                                Forms\Components\Select::make('category_id')->label('categorie')
                                    ->options(Category::query()->pluck('name', 'id'))
                                    ->live()
                                    ->searchable()
                                    ->native(false),

                                Forms\Components\Select::make('sub_category')->label('Sous categorie')
                                    ->options(fn (Get $get): Collection => SubCategory::query()
                                        ->where('category_id', $get('category_id'))
                                        ->pluck('name', 'id'))

                                    ->multiple()
                                    ->searchable()
                                    ->native(false),




                            ]),

                        Fieldset::make('Prix')
                            ->schema([
                                // ...
                                TextInput::make('basic_price')->label('Prix du Service')->required(),

                                TextInput::make('basic_revision')->label('Revisions')
                            ])
                            ->columns(2),

                        RichEditor::make('description'),

                        RichEditor::make('need_serivce')->label('Besoin service')->helperText('Ce dont vous auriez besoin pour realiser le service'),


                        // ...


                        //->imageResizeMode('cover')
                        //->imageCropAspectRatio('16:9'),
                        RichEditor::make('samples')->label('Quelques Realisation lier')
                            ->fileAttachmentsDisk('local')
                            ->fileAttachmentsDirectory('public/attachments'),


                        Forms\Components\TagsInput::make('basic_support')->label('Support du service')->hint('Support du service')->suggestions([
                            'tailwindcss',
                            'alpinejs',
                            'laravel',
                            'livewire',
                            'photographie',
                        ])->placeholder('Maintenance, Suivie'),
                        Forms\Components\TextInput::make('video_url')->label('video(facultatif)')
                            ->url()
                            ->prefix('https://')
                            ->hint('lien explicatif du service'),





                        Fieldset::make('Prix')
                            ->schema([
                                // ...
                                TextInput::make('basic_delivery_time')->label('Temps De livraison')->required(),
                                Select::make('delivery_time_unit')->label('Temps de livraison')
                                    ->options([
                                        'jour(s)' => 'jour(s)',
                                        'heure(s)' => 'heure(s)',

                                    ])->required(),

                            ]),


                        Toggle::make('is_publish')->label('Publier'),
                    ])->collapsible()



                //
            ])
            ->statePath('data')
            ->model(Service::class);
    }


    public function edit(): void
    {
        $this->editForm->validate();

try {


    $data = $this->editForm->getState();
    $this->record->update($data);

            $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);

}catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);

}


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

                $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);


            $this->dispatch('refresh');
        } else {

            $this->record->files = $data;
            $this->record->update();
        }
        } catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);

        }
    }


    protected function getForms(): array
    {
        return [
            'editForm',
            'imageForm',

        ];
    }

    public function editImage()
    {



        $this->imageForm->validate();
        $fileName = $this->imageForm->getState();

        try{
            $data = $this->record->files;
            foreach ($fileName['files'] as $file) {
                $data[] = $file;
            }

            $this->record->files = $data;
            $this->record->update();


            $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);


            $this->imageForm->fill();

            $this->dispatch('refresh');

        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);
        }


    }

    public function render(): View
    {
        return view('livewire.freelance.services.service-edit');
    }
}
