<?php

namespace App\Livewire\User\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Laravel\Jetstream\Jetstream;
use Filament\Forms\Get;
use Filament\Tables\Actions\{BulkAction, Action};
use Illuminate\Support\Collection;

use Filament\Forms\Components\{DateTimePicker, TextInput, RichEditor, DatePicker, MarkdownEditor, Select, Toggle, FileUpload, Section};
use Filament\Notifications\Notification;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;




class NewUser extends Component

implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms;
    public $phone;

    public $user = ["name" => "", "email" => "", "password" => "", "password_confirmation" => "", "terms" => false];


    public function mount()
    {
        $this->form->fill();
    }

    public function register()
    {
        $this->form->validate();

        $data=$this->form->getState();

       // dd($data);




       $this->validate(['data.phone'=>'unique:users,phone']);


        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($newUser);



        return redirect()->intended('user/dashboard');
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
            ->placeholder("Nom d'utilisateur")
            ->prefixIcon('heroicon-m-user')
            ->required(),

            TextInput::make('email')
            ->email()
            ->autocomplete(false)
            ->placeholder("Email")
            ->prefixIcon('heroicon-m-at-symbol')
            ->required()
            ->unique(table: User::class),

            PhoneInput::make('phone')
            ->placeholder("phone")
            ->required()
            ->countryStatePath('phone_country')
            ->initialCountry('cd')
            ->unique(table: User::class)
            ->displayNumberFormat(PhoneInputNumberType::E164)


            ->focusNumberFormat(PhoneInputNumberType::E164),
           // ->inputNumberFormat(PhoneInputNumberType::E164),

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
            ->statePath('data');
    }
    public function render()
    {
        return view('livewire.user.auth.new-user');
    }
}
