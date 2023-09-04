<?php

namespace App\Tools;

use Stripe\Stripe;
use Stripe\Token;
use Stripe\charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\Transaction;



class Paiement
{


    public function PayementAction(array $card, $price)
    {


        if (!empty($card['name']) && !empty($card['cardNumber']) && !empty($card['cardExpiryMonth']) && !empty($card['cardExpiryYear']) && !empty($card['cardCvc'])) {



            try {

                Stripe::setApiKey(env('STRIPE_KEY_SECRET'));

                $existingCustomers = Customer::all(['email' => auth()->user()->email]);
                if ($existingCustomers->count() === 0) {
                    $customer = Customer::create([
                        'email' => auth()->user()->email,
                        'name' => auth()->user()->name,
                        'phone' => auth()->user()->phone,

                    ]);
                    $customerId = $customer->id;
                } else {
                    $customerId = $existingCustomers->data[0]->id;
                }

                $existingPaymentMethods = PaymentMethod::all([
                    'customer' => $customerId,
                    'type' => 'card',
                ]);

                $desiredPaymentMethod = $card['cardNumber']; // ou toute autre valeur pour identifier la méthode de paiement souhaitée

                $paymentMethodExists = false;
                $paymentMethodId = '';

                foreach ($existingPaymentMethods->data as $paymentMethod) {
                    if ($paymentMethod->card->last4 === $desiredPaymentMethod) {
                        $paymentMethodExists = true;
                        $paymentMethodId = $paymentMethod->id;
                        break;
                    }
                }

                if ($paymentMethodExists) {

                    // La méthode de paiement existe déjà
                } else {
                    // La méthode de paiement n'existe pas encore
                    // Vous pouvez créer une nouvelle méthode de paiement et l'attacher au client
                    $paymentMethod = PaymentMethod::create([
                        'type' => 'card',
                        'card' => [
                            'number' => $card['cardNumber'],
                            'exp_month' => $card['cardExpiryMonth'],
                            'exp_year' => $card['cardExpiryYear'],
                            'cvc' => $card['cardCvc'],
                        ],
                    ]);
                    $paymentMethod->attach(['customer' => $customerId]);
                    $paymentMethodId = $paymentMethod->id;

                    $paymentIntent = PaymentIntent::create([
                        'amount' => $price * 100,
                        'currency' => 'usd',
                        'description' => 'Paiement de service',
                        'payment_method' => $paymentMethodId,
                        'customer' => $customerId,
                    ]);

                    $paymentIntent->confirm();
                    $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
                    $lastFour = $paymentMethod->card->last4;
                    $brand = $paymentMethod->card->brand;

                    $identityPayment = ['last4' => $lastFour, 'brand' => $brand];

                    $response = ['identityPayment' => $identityPayment, 'paymentIntent' => $paymentIntent->id, 'status' => true];
                    return response()->json($response, 200);
                }
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction de base de données

                // Retourner une réponse d'erreur

                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            } catch (\Stripe\Exception\CardException $e) {
                // Gérer l'erreur liée à la carte de crédit

                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            } catch (\Stripe\Exception\RateLimitException $e) {
                // Gérer l'erreur liée à la limite de taux
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Gérer l'erreur liée à une requête invalide
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            } catch (\Stripe\Exception\AuthenticationException $e) {
                // Gérer l'erreur liée à une authentification invalide

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                // Gérer l'erreur liée à une connexion API
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Gérer toutes les autres erreurs API
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => false
                ], 500);
            }
        } else {
        }
    }

    public function checkoutmaxi($prix, $telephone, $reference, $succesUrl, $canceUrl, $failureUrl)
    {

        $payType = "MaxiCash";
        $currency = "maxiDollar";
        $amount = $prix;
        $telephone = $telephone;
        $reference = $reference;

        // Construire les données de la requête
        $requestData = [
            'PayType' => $payType,
            'MerchantID' => env('MerchantID', "4930750f63334559967e9f7335b3862d"),
            'MerchantPassword' => env('MerchantPassword', "99d90bd5d1184f5096dabf62f6b59a07"),
            'Amount' => $amount,
            'Currency' => $currency,
            'Telephone' => $telephone,
            'Language' => 'fr',
            "Reference" => $reference,
            "SuccessURL" => $succesUrl,
            "FailureURL" =>  $failureUrl,
            "CancelURL" =>  $canceUrl,


            // Ajouter d'autres données de requête nécessaires
        ];





        // Envoyer la requête HTTP avec les données du formulaire
        // Construire les données de la requête


        // Construire l'URL de redirection avec les données du formulaire
        $url = 'https://api-testbed.maxicashapp.com/PayEntry?data=' . urlencode(json_encode($requestData));

        //
        return redirect($url);
    }
}
