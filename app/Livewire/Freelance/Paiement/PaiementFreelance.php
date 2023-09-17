<?php

namespace App\Livewire\Freelance\Paiement;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Stripe\Stripe;
use Stripe\Transfer;

use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\UnexpectedValueException;

#[Layout('layouts.freelance-layout')]
#[Title('Paiement')]
class PaiementFreelance extends Component
{
    public $solde;
    public $choix;
    public $modal;
    public $montant_maxi;
    public $montant_carte;
    public $compte_bancaire;
    public $mot_de_passe;
    public $mobile_maxi;
    public $soldeFreelance;
    public $maxiCash = false;
    public $carteBancaire = false;
    public function mount()
    {

        // dd($this->solde);

        $this->soldeFreelance
            = Auth::user()->freelance->getSolde();
    }

    public function getSolde()
    {

        $solde = Auth::user()->freelance->getSolde();
        return '$' . number_format($solde, 2, ',', ' ');
    }


    public function choixRetrait()
    {
        $this->validate(['choix' => 'required'], ['choix.required' => 'Veuillez choisir une methode retrait.']);



        if ($this->choix === "carte_bancaire") {

            $this->carteBancaire = true;
            $this->maxiCash = false;
        } else if ($this->choix === "cheque") {
        } else if ($this->choix === "maxi_cash") {

            $this->maxiCash = true;
            $this->carteBancaire = false;
        }

        // dd($this->choix);
    }

    public function RetraitMaxi()
    {


        $this->validate([
            'montant_maxi' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $solde = $this->soldeFreelance;

                if ($value > $solde) {
                    $fail("Le montant ne doit pas dépasser le solde disponible.");
                }
            }],
            'mot_de_passe' => 'required',
            'mobile_maxi' => 'required'
        ]);
    }

    public function demanderRetraitCarte()
    {
        // Valider les entrées utilisateur
        $this->validate([
            'montant_carte' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $solde = $this->soldeFreelance;

                if ($value > $solde) {
                    $fail("Le montant ne doit pas dépasser le solde disponible.");
                }
            }],
            'mot_de_passe' => ['required', function ($attribute, $value, $fail) {
                // Vérifier si le mot de passe correspond à celui de l'utilisateur connecté
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail("Le mot de passe est incorrect.");
                }
            }],
            'compte_bancaire' => 'required',


        ]);


        try {
            Stripe::setApiKey(env('STRIPE_KEY_SECRET'));

            // Créer une transaction de retrait avec Stripe
            $transfer = Transfer::create([
                'amount' => $this->montant_carte * 100, // Le montant en centimes
                'currency' => 'usd',
                'destination' => $this->compte_bancaire,
                // Ajoutez d'autres paramètres de retrait selon vos besoins
            ]);

            // Enregistrement des informations de retrait dans la table "paiement"
            // $paiement = new Paiement();
            //$paiement->montant = $this->montant;
            //$paiement->statut = $transfer->status == 'paid' ? 'effectué' : 'en attente';
            // Ajoutez d'autres colonnes de la table "paiement" selon vos besoins
            //$paiement->save();

            session()->flash('message', 'La demande de retrait a été effectuée avec succès.');
            // Réinitialiser les valeurs des champs
            $this->montant_carte = null;
            $this->compte_bancaire = null;
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            $this->dispatchBrowserEvent('error', [
                'message' => 'Une erreur est survenue lors de la demande de retrait : ' . $e->getMessage()
            ]);
        } catch (
            CardException | InvalidRequestException | RateLimitException | ApiConnectionException |
            AuthenticationException | ApiErrorException | UnexpectedValueException $e
        ) {
            // Gérer les erreurs spécifiques à Stripe
            //session()->flash('error', 'Une erreur est survenue lors de la demande de retrait : ' . $e->getMessage());

            $this->dispatchBrowserEvent('error', [
                'message' => 'Une erreur est survenue lors de la demande de retrait : ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {

        $this->solde = $this->getSolde();
        return view('livewire.freelance.paiement.paiement-freelance');
    }
}
