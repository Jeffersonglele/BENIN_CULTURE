<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeContenu;

class MediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::all();
        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeContenus = TypeContenu::all();
        $contenus = Contenu::all();
        return view('medias.create', compact('typeContenus', 'contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    \Log::info('====== DÉBUT UPLOAD MÉDIA ======');
    
    try {
        if (!$request->hasFile('fichier')) {
            \Log::warning('Aucun fichier "fichier" dans la requête');
            return back()->with('error', 'Aucun fichier n\'a été sélectionné.');
        }
        
        $file = $request->file('fichier');
        
        if (!$file->isValid()) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la limite de taille définie dans php.ini (2MB)',
                UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la limite de taille définie dans le formulaire',
                UPLOAD_ERR_PARTIAL => 'Le fichier n\'a été que partiellement téléchargé',
                UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été téléchargé',
                UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
                UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque',
                UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté l\'upload',
            ];
            
            $errorCode = $file->getError();
            $errorMessage = $errorMessages[$errorCode] ?? 'Erreur inconnue de téléchargement';
            
            return back()->with('error', "Erreur de téléchargement : $errorMessage");
        }
        
        // **SAUVEGARDER LES INFORMATIONS DU FICHIER AVANT DE LE DÉPLACER**
        $fileSize = $file->getSize();
        $fileType = $file->getMimeType();
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        \Log::info('Informations fichier sauvegardées:', [
            'size' => $fileSize,
            'type' => $fileType,
            'name' => $originalName,
            'extension' => $extension,
        ]);
        
        // Validation (note: la validation Laravel accède aussi au fichier, donc elle doit venir avant le move)
        $validated = $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'fichier' => [
                'required',
                'file',
                'max:102400', // **NOTE: Votre php.ini limite à 2MB !**
                'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv,flv,webm,mkv,quicktime'
            ],
            'description' => 'required|string|max:1000',
            'prix' => 'nullable|integer|min:0|max:999999',
        ], [
            'fichier.max' => 'Le fichier est trop volumineux. Taille maximale : 100MB (limite serveur)',
            'fichier.mimes' => 'Format de fichier non supporté',
        ]);
        
        \Log::info('Validation réussie');
        
        // Déterminer le type (image/video) AVANT de déplacer
        $type = strpos($fileType, 'image/') === 0 ? 'image' : 'video';
        $subFolder = $type . 's'; // images ou videos
        
        // Créer le dossier de destination
        $destinationPath = public_path('medias/' . $subFolder);
        
        if (!file_exists($destinationPath)) {
            if (!mkdir($destinationPath, 0777, true)) {
                \Log::error('Impossible de créer le dossier', ['path' => $destinationPath]);
                return back()->with('error', 'Impossible de créer le dossier de destination');
            }
        }
        
        // Vérifier les permissions d'écriture
        if (!is_writable($destinationPath)) {
            \Log::error('Dossier non accessible en écriture', ['path' => $destinationPath]);
            return back()->with('error', 'Le dossier de destination n\'est pas accessible en écriture');
        }
        
        // Générer un nom de fichier unique
        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $fullPath = $destinationPath . '/' . $fileName;
        
        // **DÉPLACER LE FICHIER**
        try {
            if ($file->move($destinationPath, $fileName)) {
                \Log::info('Fichier déplacé avec succès', [
                    'destination' => $fullPath,
                    'taille_finale' => filesize($fullPath), // Utiliser filesize() sur le nouveau chemin
                ]);
            } else {
                \Log::error('Échec du déplacement du fichier');
                return back()->with('error', 'Échec du déplacement du fichier vers le dossier de destination');
            }
        } catch (\Exception $e) {
            \Log::error('Exception lors du déplacement:', [
                'message' => $e->getMessage(),
                'path' => $destinationPath,
            ]);
            return back()->with('error', 'Erreur lors du déplacement du fichier: ' . $e->getMessage());
        }
        
        // Chemin pour la base de données (relatif à public/)
        $dbPath = 'medias/' . $subFolder . '/' . $fileName;
        
        // **CRÉER LE MÉDIA** en utilisant les informations sauvegardées
        try {
            $media = Media::create([
                'id_contenu' => $validated['id_contenu'],
                'id_type_contenu' => $validated['id_type_contenu'],
                'chemin' => $dbPath,
                'description' => $validated['description'],
                'prix' => $validated['prix'] ?? 0,
                'type' => $type,
                'taille' => $fileSize, // Utiliser la taille sauvegardée
                'mime_type' => $fileType, // Utiliser le type MIME sauvegardé
                'nom_original' => $originalName, // Utiliser le nom sauvegardé
            ]);
            
            \Log::info('Média créé avec succès ID: ' . $media->id);
            
            return redirect()->route('admin.medias.index')
                ->with('success', 'Média créé avec succès!');
                
        } catch (\Exception $e) {
            \Log::error('Erreur création média en base:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Si erreur BD, supprimer le fichier uploadé
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            
            return back()->with('error', 'Erreur lors de la création en base de données: ' . $e->getMessage());
        }
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Erreur validation:', ['errors' => $e->errors()]);
        return back()->withInput()->withErrors($e->validator);
            
    } catch (\Exception $e) {
        \Log::error('Exception inattendue:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
        
        return back()->withInput()
            ->with('error', 'Erreur inattendue: ' . $e->getMessage());
    }
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::with(['contenu', 'typeContenu'])->findOrFail($id);
        return view('medias.show', compact('media'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);
        $typeContenus = TypeContenu::all();
        $contenus = Contenu::all();
        return view('medias.edit', compact('media', 'typeContenus', 'contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Log::info('Début de la mise à jour du média', [
            'media_id' => $id, 
            'request_data' => $request->all(),
            'has_file' => $request->hasFile('chemin'),
            'file_valid' => $request->file('chemin') ? $request->file('chemin')->isValid() : false
        ]);

        $validated = $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'description' => 'required|string',
            'chemin' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:102400',
        ]);

        $media = Media::findOrFail($id);
        
        try {
            if ($request->hasFile('chemin') && $request->file('chemin')->isValid()) {
                $file = $request->file('chemin');
                $destinationPath = public_path('medias');
                
                // Supprimer l'ancien fichier s'il existe
                if ($media->chemin && file_exists(public_path($media->chemin))) {
                    unlink(public_path($media->chemin));
                }

                // Générer un nom de fichier unique
                $fileName = time() . '_' . $file->getClientOriginalName();
                
                // Déplacer le fichier
                $file->move($destinationPath, $fileName);
                
                // Mettre à jour le chemin
                $media->chemin = 'medias/' . $fileName;
                
                // Mettre à jour le type
                $fileType = $file->getMimeType();
                $media->type = strpos($fileType, 'image/') === 0 ? 'image' : 'video';
            }

            // Mettre à jour les autres champs
            $media->id_contenu = $validated['id_contenu'];
            $media->id_type_contenu = $validated['id_type_contenu'];
            $media->description = $validated['description'];
            
            $media->save();

            return redirect()->route('admin.medias.index')
                ->with('success', 'Média mis à jour avec succès.');

        } catch (\Exception $e) {
            \Log::error('Erreur lors de la mise à jour du média', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Erreur lors de la mise à jour du média : ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = \App\Models\Media::findOrFail($id);
        
        try {
            $media->delete();
            
            return redirect()->route('admin.medias.index')
                ->with('success', 'Média supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage());
        }
    }
}