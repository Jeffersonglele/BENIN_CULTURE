<?php

namespace App\Http\Controllers\Author;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MediaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Liste des médias
     */
    public function index()
    {
        $userId = auth('utilisateur')->id();

        $medias = Media::whereHas('contenu', function ($query) use ($userId) {
            $query->where('id_auteur', $userId);
        })->with(['contenu', 'typeContenu'])->get();

        return view('author.medias.index', compact('medias'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        $userId = auth('utilisateur')->id();
        $contenus = \App\Models\Contenu::where('id_auteur', $userId)->get();
        $typeContenus = \App\Models\TypeContenu::all();

        return view('author.medias.create', compact('contenus', 'typeContenus'));
    }

    /**
     * Initialisation du paiement : génère le token FedaPay
     */
    public function initPayment(Request $request)
    {
        try {
            \FedaPay\FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
            \FedaPay\FedaPay::setEnvironment(env('FEDAPAY_ENV'));

            $checkout = \FedaPay\Checkout::create([
                'amount' => 1000,
                'currency' => 'XOF',
                'description' => 'Paiement pour l\'ajout de contenu média',
            ]);

            return response()->json([
                'success' => true,
                'token' => $checkout->id,
                'public_key' => env('FEDAPAY_PUBLIC_KEY'),
                'mode' => env('FEDAPAY_ENV')
            ]);

        } catch (\Exception $e) {
            \Log::error('FedaPay Error: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur d\'authentification ou de serveur FedaPay.'
            ], 500);
        }
    }

    /**
     * Redirect retour FedaPay
     */
    public function paymentCallback(Request $request)
    {
        try {
            \FedaPay\FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
            \FedaPay\FedaPay::setEnvironment(env('FEDAPAY_ENV'));

            $transaction = \FedaPay\Transaction::retrieve($request->id);

            if ($transaction->status === 'approved') {
                return redirect()->route('author.medias.create')->with('success', 'Paiement approuvé ! Vous pouvez maintenant uploader votre média.');
            }

            return redirect()->route('author.medias.create')->with('error', 'Paiement non approuvé.');
        } catch (\Exception $e) {
            return redirect()->route('author.medias.create')->with('error', 'Erreur callback paiement.');
        }
    }

    /**
     * Sauvegarde du média après paiement
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'fichier' => 'required|file|max:10240',
            'payment_token' => 'required|string',
        ]);

        try {
            \FedaPay\FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
            \FedaPay\FedaPay::setEnvironment(env('FEDAPAY_ENV'));

            $transaction = \FedaPay\Transaction::retrieve($request->payment_token);

            if ($transaction->status !== 'approved') {
                return back()->with('error', 'Paiement non approuvé.');
            }

            $file = $request->file('fichier');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('medias', $fileName, 'public');

            $media = Media::create([
                'chemin' => $filePath,
                'description' => $request->description,
                'id_contenu' => $request->id_contenu,
                'id_type_contenu' => $request->id_type_contenu,
                'transaction_id' => $transaction->id,
                'amount' => $transaction->amount,
                'payment_status' => $transaction->status,
                'payment_method' => $transaction->mode
            ]);

            return redirect()->route('author.medias.show', $media->id)
                ->with('success', 'Média ajouté avec succès !');

        } catch (\Exception $e) {
            Log::error("Erreur store media : " . $e->getMessage());
            return back()->with('error', 'Erreur paiement ou upload.');
        }
    }

    /**
     * Webhook FedaPay (ne dépend pas du frontend)
     */
    public function handleCallback(Request $request)
    {
        $signature = $request->header('X-FedaPay-Signature');
        $expected = hash_hmac('sha256', $request->getContent(), config('services.fedapay.webhook_secret'));

        if (!hash_equals($signature, $expected)) {
            return response()->json(['error' => 'Signature invalide'], 403);
        }

        $data = $request->input('data');
        if ($request->input('event') === 'transaction.approved') {
            Media::where('transaction_id', $data['id'])
                ->update(['payment_status' => 'approved']);
        }

        return response()->json(['status' => 'ok']);
    }


    /**
     * Affichage d’un média
     */
    public function show(Media $media)
    {
        $this->authorize('view', $media);
        return view('author.medias.show', compact('media'));
    }

    /**
     * Edition
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);

        if ($media->contenu->id_auteur !== auth('utilisateur')->id()) {
            abort(403);
        }

        $typeContenus = \App\Models\TypeContenu::all();
        return view('author.medias.edit', compact('media', 'typeContenus'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, string $id)
    {
        $media = Media::findOrFail($id);

        if ($media->contenu->id_auteur !== auth('utilisateur')->id()) {
            abort(403);
        }

        return view('author.medias.update', compact('media'));
    }

    /**
     * Suppression média
     */
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);

        if ($media->contenu->id_auteur !== auth('utilisateur')->id()) {
            abort(403);
        }

        $media->delete();
        return redirect()->route('author.medias.index')->with('success', 'Média supprimé.');
    }
}
