<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class verifySocialMedia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        $check = Hash::check('findDefault', $user->password);

        // Si l'utilisateur essaie d'accéder à la route "Change password"
        if ($request->routeIs('changePassword')) {
            // Si le mot de passe de l'utilisateur n'est pas la valeur par défaut
            if (!$check) {
                // Redirigez-le vers le tableau de bord
                return redirect()->route('dashboardUser');
            }
        } elseif ($check) {
            // Si l'utilisateur a le mot de passe par défaut sur n'importe quelle autre route
            return redirect()->route('changePassword');
        }

        return $next($request);
    }
}


