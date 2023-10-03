<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class PayementController extends Controller
{
    //


    public function paiement_status($transaction_numero)
    {

        $transaction = Transaction::where('transaction_numero', $transaction_numero)->first();


        if (!$transaction) {
            return redirect()->back()->withErrors(['message' => 'Une erreur s\'est produite.']);
        }

        return view('other.status-paiement', ['transaction' => $transaction]);
    }



    public function paiment_maxi()
    {
        // Récupérer les données de la requête de confirmation de paiement
        $status = request('status');
        $reference = request('reference');
        $method = ['last4' => request('Method'), 'brand' => "maxicash"];
        // Ajouter d'autres paramètres de la requête que vous souhaitez traiter

        // Vérifier le statut de paiement
        if ($status === 'failed') {


            $payment = Transaction::where('payment_token', $reference)->first();


            $payment->payment_token = $reference;
            $payment->status = 'failed';
            $payment->update();


            // Rediriger vers une page d'échec
            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        } else if ($status === "success") {


            $cart = Session::has('cart') ? Session::get('cart') : null;
            $datas = $this->saveService();
            try {

                $payment = Transaction::where('payment_token', $reference)->first();


                $payment->payment_method = $method;
                $payment->payment_token = $reference;
                $payment->status = 'completed';




                $payment->update();

                $payment->sendMail();

                // Parcourir toutes les commandes pour les mettre à jour
                foreach ($datas as $order) {

                    // Mettre à jour le statut de la commande dans la table "commandes"
                    $orderToUpdate = Order::findOrFail($order->id);
                    $orderToUpdate->status = 'completed';

                    $orderToUpdate->transaction_id = $payment->id; // Lier la commande au paiement effectué
                    $orderToUpdate->save();

                     $orderToUpdate->notifyUser();
                }

                // Valider et terminer la transaction de base de données


                // Retourner une réponse de succès
                Session::forget('cart');
                // return view('status.success', ['order' => $payment->transaction_numero]);
                return redirect()->route('checkoutStatus', $payment->transaction_numero);
                //return response()->json(['success' => 'Paiement traité avec succès']);
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction de base de données



                return redirect()->route('checkout')->withErrors(['message' => $e->getMessage()]);
            }




            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        } else {
            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        }
    }


    public function paiment_maxi_mission()
    {
        // Récupérer les données de la requête de confirmation de paiement
        $status = request('status');
        $reference = request('reference');
        $method = ['last4' => request('Method'), 'brand' => "maxicash"];
        // Ajouter d'autres paramètres de la requête que vous souhaitez traiter

        // Vérifier le statut de paiement
        if ($status === 'failed') {


            // Rediriger vers une page d'échec
            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        } else if ($status === "success") {





            try {
                // Enregistrer les informations de paiement dans la table "Transaction"
                $payment = new Transaction();
                $payment->user_id = auth()->id();
               // $payment->amount = $cart->totalPrice;
                $payment->payment_method = $method;
                $payment->payment_token = $reference;
                $payment->status = 'completed';

                $payment->save();


                // return view('status.success', ['order' => $payment->transaction_numero]);
                return redirect()->route('checkoutStatus', $payment->transaction_number);
                //return response()->json(['success' => 'Paiement traité avec succès']);
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction de base de données



                return redirect()->route('checkout')->withErrors(['message' => $e->getMessage()]);
            }




            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        } else {
            return redirect()->route('checkout')->withErrors(['message' => 'Une erreur s\'est produite.']);
        }
    }

    function saveService()
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

                ];
                $datas[] = Order::create($data);
            }



            return $datas;
        } catch (\Exception $e) {
        };
    }
}
