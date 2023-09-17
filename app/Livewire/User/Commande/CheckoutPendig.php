<?php

namespace App\Livewire\User\Commande;

use App\Models\Order;
use Livewire\Component;

use App\Models\Transaction;

use App\Tools\Cart;
use App\Tools\Paiement;
use Illuminate\Support\Facades\Session;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;

use Livewire\WithFileUploads;
use Filament\Forms\Components\Grid;

use Filament\Forms\Components\{TextInput, Textarea, Section, DatePicker};
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.user-layout')]

#[Title('Paiement')]

class CheckoutPendig extends Component implements HasForms
{

    use InteractsWithForms;
    public $product;
    public $telephone;
    public $name;
    public $order;
    public $priceTotal = null;

    public $month;
    public $year;
    public $products;
    public $localisation = ['adresse' => '', ' commune' => '', 'ville' => ''];
    public $maxi = ['name' => '', 'number' => ''];
    public $card = ['name' => '', 'cardExpiryMonth' => '10', 'cardNumber' => '4242424242424242', 'cardExpiryYear' => '2024', 'cardCvc' => ''];


    public function mount($order_number){

        $exist = Order::where('order_numero', $order_number)->where('status','=', 'pending')->exists();


        if ($exist) {

            $this->order = Order::where('order_numero', $order_number)->first();


            $this->month = $this->getMonth();
            $this->year = $this->getYear();

        } else {

            session()->flash('error', 'Route inexistante');
            return $this->redirectRoute('commandeUser');
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

    function totalPrice()
    {

        return $this->order->total_amount * 100;
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
                $payment->amount = $this->priceTotal;
                $payment->payment_method = $statusResponse['identityPayment'];
                $payment->payment_token = $statusResponse['paymentIntent'];
                $payment->status = 'completed';
                $payment->type = 'paiement';
                $payment->save();

                $this->order->status = "completed";
                $this->order->transaction_id = $payment->id;
                $this->order->update();
                $this->order->notifyUser();


                $payment->sendMail();

                $this->dispatch('notify', [
                    'message' => "Mission creer avec success",
                    'icon' => 'success',
                ]);

                Session::forget('cart');

                return $this->redirect(route("checkoutStatus", $payment->transaction_numero), false);
            } catch (\Exception $e) {

                $this->dispatch('error', ['message' => $e->getMessage(), 'title' => 'Error',  'icon' => 'error']);
            }
        }
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

        $this->products = $this->order->service;

        $this->priceTotal
        = $this->order->total_amount;
        return view('livewire.user.commande.checkout-pendig');
    }
}
