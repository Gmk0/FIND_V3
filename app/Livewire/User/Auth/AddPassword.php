<?php

namespace App\Livewire\User\Auth;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

use Filament\Forms\Components\{DateTimePicker, TextInput, RichEditor, DatePicker, MarkdownEditor, Select, Toggle, FileUpload, Section};


use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;


#[Layout('layouts.guest')]
#[Title('Freelance Commande')]

class AddPassword extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $record;

    public function mount(): void
    {

        $this->record = auth()->user();


        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            //
            TextInput::make('name')
            ->placeholder("Nom d'utilisateur")
            ->prefixIcon('heroicon-m-user')
            ->required()
            ->disabled(),

            TextInput::make('email')
            ->email()
            ->autocomplete(false)
            ->placeholder("Email")
            ->prefixIcon('heroicon-m-at-symbol')
            ->required()
            ->disabled(),

            PhoneInput::make('phone')
                ->placeholder("phone")
                ->required()
            ->countryStatePath('phone_country')
         ->initialCountry('cd')
            ->displayNumberFormat(PhoneInputNumberType::E164)

            ->unique(table: User::class),
            //->focusNumberFormat(PhoneInputNumberType::E164),

            TextInput::make('password')
            ->placeholder("Mot de passe")
            ->autocomplete(false)
            ->password()
                ->confirmed()
                ->minLength(8)
                ->prefixIcon('heroicon-m-lock-closed')
                ->required(),

            TextInput::make('password_confirmation')
            ->placeholder("Confirmer")
            ->autocomplete(false)
            ->minLength(8)
            ->password()
                ->prefixIcon('heroicon-m-lock-closed')
                ->required(),

            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function edit()
    {

            $this->form->validate();


        try{
            $data = $this->form->getState();

            $this->record->update($data);

            return redirect()->route('DashbordUser');

        }catch(\Exception $e){

            $this->dispatch('error', [
                'message' => "une erreur s'est produite",
                'icon' => 'error',
                'title' => 'error'
            ]);

        }



    }

    public function render(): View
    {
        return view('livewire.user.auth.add-password');
    }
}
