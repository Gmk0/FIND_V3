<?php

namespace App\Http\Controllers;

use App\Models\ClientLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkCustom extends Controller
{

    public function acceder($uniqueId)
    {
        // Recherchez le lien dans la base de données

        $clientLink = ClientLink::where('uniqueId', $uniqueId)->first();


        // Vérifiez si le lien correspond à un utilisateur authentifié
        if ($clientLink && Auth::check() && $clientLink->user_id === Auth::id()) {
            // Utilisateur authentifié, redirigez vers la page appropriée



            return view('other.paiement-custom',['proposal'=> $clientLink->proposal]);
        }

        // Lien invalide ou non autorisé pour cet utilisateur
        abort(403, 'Accès non autorisé');
    }
    //
}
