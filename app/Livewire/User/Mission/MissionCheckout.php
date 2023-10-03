<?php

namespace App\Livewire\User\Mission;

use App\Models\Mission;
use Livewire\Component;
;
use App\Models\MissionResponse;
use Exception;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;

use Livewire\WithFileUploads;
use Filament\Forms\Components\Grid;

use Filament\Forms\Components\{TextInput, Textarea, Section, DatePicker};
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use App\Models\Transaction;

use App\Tools\Cart;
use App\Tools\Paiement;
use Illuminate\Support\Facades\Session;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;


use Livewire\Attributes\{Layout, Title};



#[Layout('layouts.user-layout')]

#[Title('Mission Paiment')]

class MissionCheckout extends Component

implements HasForms
{
    use InteractsWithForms;


    public $response;
    public $mission;
    public $product;
    public $telephone;
    public $name;
    public $priceTotal = null;
    public $month;
    public $year;
    public $localisation = ['adresse' => '', ' commune' => '', 'ville' => ''];
    public $maxi = ['name' => '', 'number' => ''];
    public $card = ['name' => '', 'cardExpiryMonth' => '10', 'cardNumber' => '4242424242424242', 'cardExpiryYear' => '2024', 'cardCvc' => ''];



    public function mount($mission_numero)
    {

        $this->response = MissionResponse::where('response_numero', $mission_numero)

            ->where('status', 'approved')
            ->where('is_paid',null)
            ->first();


        if
        (!empty($this->response)) {


            $this->mission = Mission::where('id', $this->response->mission->id)
                ->where('user_id', auth()->id())
                ->where('status', 'active')
                ->where('is_paid', null)
                ->first();

            if (!empty($this->mission)) {


                $this->month = $this->getMonth();
                $this->year = $this->getYear();
            } else {

                session()->flash('error', 'Route inexistante');
                return $this->redirect(route('MissionUser'));
            }
        } else {
            session()->flash('error', 'Route inexistante');

            return $this->redirect(route('MissionUser'));
        }
    }


    public function addressForm(Form $form): Form
    {
        return $form->schema([

            TextInput::make('localisation.adresse'),
            TextInput::make('localisation.commune'),
            TextInput::make('localisation.ville'),




        ]);
    }
    public function maxiForm(Form $form): Form
    {

        return $form->schema([

            TextInput::make('maxi.name')->required(),
            TextInput::make('maxi.number')->hint("+243 844720350")->required()->length(10),
        ]);
    }

    public function  creditForm(Form $form): Form
    {
        return $form->schema([
            TextInput::make('card.name')->required(),

            TextInput::make('card.cardNumber')
            ->mask(RawJs::make(<<<'JS'
                         $input.startsWith('34') || $input.startsWith('37') ? '9999 999999 99999' : '9999 9999 9999 9999'
                JS))->required(),
            Grid::make([
                'default' => 3,
                'sm' => 3,
                'md' => 3
            ])->schema([
                Select::make('card.cardExpiryMonth')->label('mois')->options($this->month)->native(true)->placeholder('mois')->required(),
                Select::make('card.cardExpiryYear')->label('annee')->options($this->year)->native(true)->placeholder('annee')->required(),
                TextInput::make('card.cardCvc')->label('cvv')->mask('999')->required(),


            ]),



        ]);
    }

    function getMonth()
    {

        for ($i = 1; $i <= 12; $i++) {

            $data[] = $i;
        }

        return $data;
    }

    function getYear()
    {

        $data = [];

        for ($i = date('Y'); $i <= date('Y') + 11; $i++) {
            $data[$i] = $i;
        }

        return $data;
    }


    public function pay()
    {
        $this->creditForm->validate();

        $card =  $this->creditForm->getState();
        $card['card'];


        $payement = new Paiement();

        $response = $payement->PayementAction($card['card'], $this->priceTotal);


        $statusResponse = json_decode($response->getContent(), true);

        if ($statusResponse['status'] == false) {

            $this->dispatch('error', ['message' => $statusResponse['message'], 'title' => 'Error',  'icon' => 'error']);
        } else {


            try {
                $payment = new Transaction();
                $payment->user_id = auth()->id();
                $payment->amount = $this->priceTotal;
                $payment->payment_method = $statusResponse['identityPayment'];
                $payment->payment_token = $statusResponse['paymentIntent'];
                $payment->status = 'completed';
                $payment->type = 'paiement';
                $payment->save();

                $this->response->is_paid =now();
                $this->response->update();

                $this->mission->is_paid =now();
                 $this->mission->transaction_id = $payment->id;
                 $this->mission->update();

               // $payment->sendMail();

                $this->dispatch('notify', [
                    'message' => "Mission Payer avec success",
                    'icon' => 'success',
                ]);



                return $this->redirect(route("missionPaiementStatus", $payment->transaction_numero), false);
            } catch (\Exception $e) {

                $this->dispatch('error', ['message' => $e->getMessage(), 'title' => 'Error',  'icon' => 'error']);
            }
        }
    }


    public function checkoutmaxi()
    {
        $this->maxiForm->validate();

        $data = $this->maxiForm->getState();



        $succesUrl = route('checkoutStatusMaxiService');
        $faileurUrl
            = route('checkoutStatusMaxiService');
        $cancelurl
            = route('checkoutStatusMaxiService');
        $checkout = new Paiement();
        return $checkout->checkoutmaxi($this->totalPrice(),  $data['maxi']['number'], $this->references(), $succesUrl, $cancelurl, $faileurUrl);
    }

    function references()
    {
        // Générer une chaîne aléatoire unique de 16 caractères
        $randomString = uniqid();
        // Extraire les 8 premiers caractères de la chaîne aléatoire pour obtenir l'ID unique de 8 caractères
        $uniqueId = substr($randomString, 0, 8);
        // Compteur pour incrémenter la fin de l'ID unique
        $counter = DB::table('transactions')->count() + 1;
        // Concaténer le compteur à la fin de l'ID unique
        return  $finalId = 'TR' . $uniqueId . $counter;
    }
    protected function getForms(): array
    {
        return [
            'creditForm',
            'maxiForm',
            'addressForm',
        ];
    }

    public function render()
    {
        $this->priceTotal = $this->response->budget;
        return view('livewire.user.mission.mission-checkout');
    }
}
