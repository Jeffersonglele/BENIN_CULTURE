<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Paiement;

class VerifierPaiement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $contenu_id = $request->route('id');
        $user_id = auth()->id();

        // Vérifie si l'utilisateur a payé
        $paiement = Paiement::where('user_id', $user_id)
            ->where('contenu_id', $contenu_id)
            ->where('statut', 'payé')
            ->first();

        if (!$paiement) {
            return redirect()->route('paiement.error')
                ->with('error', "Vous devez payer pour accéder à ce contenu.");
        }

        return $next($request);
    }
}
