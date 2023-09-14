<?php

namespace App\Livewire\Web\Checkout;

use Livewire\Component;
use App\Models\Order;
use App\Models\Transaction;
use Livewire\Attributes\{Layout, Title};
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


#[Layout('layouts.web-layout')]

#[Title('Paiement')]

class CheckoutService extends Component

implements HasForms
{
    use InteractsWithForms;
    public $product;
    public $telephone;
    public $name;
    public $priceTotal = null;
    public $month;
    public $year;
    public $localisation=['adresse'=>'', ' commune' => '', 'ville' => ''];
    public $maxi = ['name' => '', 'number' => ''];
    public $card = ['name' => '', 'cardExpiryMonth' => '10', 'cardNumber' => '4242424242424242', 'cardExpiryYear' => '2024', 'cardCvc' => ''];




    public function mount()
    {

        $this->month = $this->getMonth();
        $this->year = $this->getYear();
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
        $priceTotal = Session::has('cart') ? Session::get('cart') : null;

        return $priceTotal?->totalPrice * 100;
    }

    public function updateQty($id, $qty)
    {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new cart($oldCart);

        $cart->updateQty($id, $qty);

        Session::put('cart', $cart);

        $this->dispatch('refreshComponent');
    }

    public function remove($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
            return $this->redirect('services', true);
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


            try{


                $payment = new Transaction();
                $payment->amount = $this->priceTotal;
                $payment->payment_method = $statusResponse['identityPayment'];
                $payment->payment_token = $statusResponse['paymentIntent'];
                $payment->status = 'completed';
                $payment->type = 'paiement';
                $payment->save();

                $datas = $this->saveService();
                foreach ($datas as $order) {
                    $orderToUpdate = Order::findOrFail($order->id);
                    $orderToUpdate->status = "completed";
                    $orderToUpdate->transaction_id = $payment->id;
                    $orderToUpdate->update();
                    $orderToUpdate->notifyUser();
                }

                $payment->sendMail();

                $this->dispatch('notify', [
                    'message' => "Mission creer avec success",
                    'icon' => 'success',
                ]);

                Session::forget('cart');

                return $this->redirect(route("checkoutStatus", $payment->transaction_numero), false);

            }catch(\Exception $e){

                $this->dispatch('error', ['message' =>$e->getMessage(), 'title' => 'Error',  'icon' => 'error']);

            }


        }
    }


    public function checkoutmaxi()
    {
        $this->maxiForm->validate();


        try{


            $data = $this->maxiForm->getState();


            $succesUrl = route('checkoutStatusMaxiService');
            $faileurUrl
                = route('checkoutStatusMaxiService');
            $cancelurl
                = route('checkoutStatusMaxiService');
            $checkout = new Paiement();


            $payment = new Transaction();
            $payment->amount
                = $this->totalPrice() / 100;;
            $payment->payment_method = ['last4' => "", 'brand' => "maxicash"];
            $payment->payment_token = $this->references();
            $payment->save();

            return $checkout->checkoutmaxi($this->totalPrice(),  $data['maxi']['number'],$payment->payment_token, $succesUrl, $cancelurl, $faileurUrl);

        }catch(\Exception $e){

            $this->dispatch('error', ['message' => $e->getMessage(), 'title' => 'Error',  'icon' => 'error']);



        }
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





    public function saveService()
    {

        $cart = Session::has('cart') ? Session::get('cart') : null;



        try {

            foreach ($cart->items as $key => $value) {

                $data = [
                    'service_id' => $key,
                    'user_id' => auth()->user()->id,
                    'total_amount' => $value['basic_price'] * $value['quantity'],
                    'quantity' => $value['quantity'],
                    'type' => 'service',
                    'status' => 'pending',

                ];



                $datas[] = Order::create($data);
            }


            // dd($datas);




            return $datas;
        } catch (\Exception $e) {
            // En cas d'erreur, annuler la transaction de base de données

            $this->dispatch('error', ['message' => $e->getMessage(), 'title' => 'Error',  'icon' => 'error']);
        };
    }


    public function render()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->product = $cart->items;
        $this->priceTotal = $this->totalPrice() / 100;
        return view('livewire.web.checkout.checkout-service');
    }
}
