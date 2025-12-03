<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function initier(Request $request)
    {
        try {
            FedaPay::setApiKey(config('services.fedapay.secret_key'));
            FedaPay::setEnvironment(config('services.fedapay.mode'));

            $transaction = Transaction::create([
                'amount' => $request->amount ?? 100,
                'description' => $request->description ?? 'Accès à un contenu premium',
                'callback_url' => route('paiement.callback'),
                'customer_id' => 5911198,
                'currency' => ['iso' => 'XOF'],
                'metadata' => [
                    'contenu_id' => $request->contenu_id ?? null,
                    'user_id' => auth()->id() ?? null
                ]
            ]);

            // Méthode correcte FedaPay
            $token = $transaction->generateToken();
            $paymentUrl = $token->url;

            return response()->json([
                'success' => true,
                'payment_url' => $paymentUrl
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur Paiement FedaPay: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du paiement : '.$e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            FedaPay::setApiKey(config('services.fedapay.secret_key'));
            FedaPay::setEnvironment(config('services.fedapay.mode'));

            $transactionId = $request->query('transaction_id');

            if (!$transactionId) {
                return redirect()->route('paiement.error')->with('error', 'Aucune transaction reçue.');
            }

            // Récupère et rafraîchit la transaction
            $transaction = Transaction::retrieve($transactionId);
            $transaction = Transaction::retrieve($transaction->id);

            \Log::info('Transaction status = '.$transaction->status);

            if (in_array($transaction->status, ['approved', 'completed'])) {

                Paiement::create([
                    'user_id' => $transaction->metadata['user_id'] ?? null,
                    'contenu_id' => $transaction->metadata['contenu_id'] ?? null,
                    'montant' => $transaction->amount,
                    'transaction_id' => $transactionId,
                    'statut' => 'payé',
                    'donnees_transaction' => json_encode($transaction)
                ]);

                return redirect()->route('paiement.success', ['transaction_id' => $transactionId]);
            }

            return redirect()->route('paiement.error')
                ->with('error', 'Le paiement a échoué ou a été annulé.');

        } catch (\Exception $e) {
            return redirect()->route('paiement.error')
                ->with('error', 'Erreur callback : '.$e->getMessage());
        }
    }


    public function success(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        return view('paiement.success', compact('transactionId'));
    }

    public function error()
    {
        return view('paiement.error');
    }

    public function verifierPaiement($contenu_id)
    {
        $user_id = auth()->id();

        $paiement = \App\Models\Paiement::where('user_id', $user_id)
            ->where('contenu_id', $contenu_id)
            ->where('statut', 'payé')
            ->first();

        return response()->json([
            'access' => $paiement ? true : false
        ]);
    }

}
