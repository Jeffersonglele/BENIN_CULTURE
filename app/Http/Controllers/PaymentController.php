<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use FedaPay\Webhook;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Handle FedaPay webhook callback
     */
    public function handleCallback(Request $request)
    {
        // Log de debug
        Log::info('Début du callback FedaPay', $request->all());

        try {
            $payload = $request->getContent();
            $signature = $request->header('X-FedaPay-Signature');

            // Construire l'événement à partir du payload
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                config('services.fedapay.webhook_secret') // Clé webhook sandbox
            );

            Log::info('Événement reçu', ['type' => $event->type]);

            // Vérifier si la transaction est approuvée
            if ($event->type === 'transaction.approved') {
                $transaction = $event->data;

                // Récupérer le média correspondant via le token envoyé par le formulaire
                $media = Media::where('transaction_id', $transaction->id)->first();

                if ($media) {
                    // Transaction approuvée, media déjà lié
                    Log::info("Media déjà lié à la transaction", ['media_id' => $media->id]);
                } else {
                    // Ici tu peux chercher un media temporaire si tu en utilises
                    Log::info("Aucun media trouvé pour cette transaction, vérifier la soumission du formulaire");
                    // Exemple : tu pourrais lier via une table temporaire ou session
                }
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Erreur dans le callback FedaPay: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error'], 400);
        }
    }
}
