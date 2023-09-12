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
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Tabs;

use Filament\Forms\Components\{TextInput, RichEditor, TagsInput,MarkdownEditor, Select, Toggle, FileUpload, Section};
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.freelance-layout')]
#[Title('Service')]

class ServiceCreation extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public $category_id;
    public function mount(): void
    {

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Service')
                ->schema([
                    // ...
                    Wizard::make([
                        Step::make('Titre')
                        ->schema([

                            Fieldset::make('tite')->schema([
                                TextInput::make('title')->label('Titre')->helperText('Donner un titre a votre service ')->required(),

                        TagsInput::make('tag')->helperText('le tag pour faciliter la recherche ')->suggestions([
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
                        ]),
                        Step::make('Support du Service')
                        ->Description('Veuillez Rajouter quelques information contenant votre service et des examples')
                        ->schema([
                            FileUpload::make('files')->label('Image Decrivant le service')
                            ->multiple()
                                ->directory('service')
                                ->imagePreviewHeight('100')

                                ->image()
                                ->imageEditor(),
                            //->imageResizeMode('cover')
                            //->imageCropAspectRatio('16:9'),
                            RichEditor::make('example')->label('Quelques Realisation lier')
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
                                ->hint('lien explicatif du service')


                        ]),
                        Step::make('Temps & Visibilite')
                        ->schema([

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

                        ])
                    ])->submitAction(new HtmlString('<button class="bg-amber-600 px-6 py-1.5 rounded-md text-white focus:bg-amber-800"  type="submit"><span wire:loading.remove>Submit</span><span wire:loading>Creation....</span></button>')),
                ])
                //
            ])
            ->statePath('data')
            ->model(Service::class);
    }

    public function create()
    {


        $this->form->validate();



        try{
            $data = $this->form->getState();

            $record = Service::create($data);


            $this->dispatch('notify', ['message' => "Mission creer avec success",'icon' => 'success',]);


            $this->form->model($record)->saveRelationships();

            return redirect()->route('freelance.service.create');

        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "Une erreur s'est produite" . $e->getMessage(),
                'icon' => 'error',
                'title' => 'error'
            ]);

        };


    }

    public function render(): View
    {
        return view('livewire.freelance.services.service-creation');
    }
}
