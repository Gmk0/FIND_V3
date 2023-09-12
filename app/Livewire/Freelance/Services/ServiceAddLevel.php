<?php

namespace App\Livewire\Freelance\Services;

use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

use Filament\Notifications\Notification;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;

#[Layout('layouts.freelance-layout')]
#[Title('Ajouter un niveau')]


class ServiceAddLevel extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Service $record;

    public function mount($service_numero)
    {
        $exist = Service::where('service_numero', $service_numero)->exists();

        if (!$exist) {

            return $this->redirect(route('freelance.service.list'));
        }

        $this->record = Service::where('service_numero', $service_numero)->first();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Premium')->schema([
                    TextInput::make('title')->label('Titre')->disabled(),

                    Fieldset::make('Prix')
                    ->schema([
                        // ...
                        TextInput::make('premium_price')->label('Prix Premium du  Service'),

                        TextInput::make('basic_price')->label('Prix basic du  Service')->disabled(),

                    ])
                        ->columns(2),

                    Fieldset::make('Support')
                    ->schema([
                        // ...
                        TagsInput::make('premium_support')->label('Support premium du service')->separator(','),
                        TagsInput::make('basic_support')->label('Support basic du service')->hint('Support Basic du service')->separator(',')->disabled(),



                    ])
                        ->columns(2),

                    Fieldset::make('Revision')
                    ->schema([
                        TextInput::make('premium_revision'),
                        TextInput::make('basic_revision')->disabled(),




                    ])
                        ->columns(2),

                    Fieldset::make('Temps de Livraison en Jours')
                    ->schema([
                        TextInput::make('premium_delivery_time'),
                        TextInput::make('basic_delivery_time')->disabled(),
                    ])
                        ->columns(2),


                ])->collapsible(),
                Section::make('Extra')->schema([
                    Fieldset::make('Prix')
                    ->schema([
                        // ...
                        TextInput::make('extra_price')->label('Prix extra du  Service'),

                        TextInput::make('basic_price')->label('Prix basic du  Service')->disabled(),

                    ])
                        ->columns(2),

                    Fieldset::make('Support')
                    ->schema([
                        // ...
                        TagsInput::make('extra_support')->label('Support extra du service')->separator(','),
                        TagsInput::make('basic_support')->label('Support basic du service')->hint('Support Basic du service')->separator(',')->disabled(),



                    ])
                        ->columns(2),

                    Fieldset::make('Revision')
                    ->schema([
                        TextInput::make('extra_revision')->label('extra revision'),
                        TextInput::make('basic_revision')->label('basic revision')->disabled(),




                    ])
                        ->columns(2),

                    Fieldset::make('Temps de Livraison en Jours')
                    ->schema([
                        TextInput::make('extra_delivery_time'),
                        TextInput::make('basic_delivery_time')->disabled(),
                    ])
                        ->columns(2),



                ])->collapsible()
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function edit(): void
    {

         $this->form->validate();

try {


    $data = $this->form->getState();
    if (!empty($data['premium_price']) && !empty($data['premium_support']) && !empty($data['premium_delivery_time'])) {

        $this->record->update($data);
        $this->dispatch('notify', ['message' => "Mission creer avec success", 'icon' => 'success',]);
    } else {

        $this->dispatch('error', [
            'message' => "Remplir tout les champs",
            'icon' => 'error',
            'title' => 'error'
        ]);
    }
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
        return view('livewire.freelance.services.service-add-level');
    }
}
