<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Liste des contenus | CULTURE BENIN</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-CxrrfATK.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        primary: '#c57e0bff',
                        dark: '#1a1a1a',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <x-navbar/>
    
    <header class="relative h-96 md:h-screen max-h-[800px] overflow-hidden">
        <!-- Image de fond -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/Photo 1 FM.jpg') }}" 
                alt="Culture Bénin" 
                class="w-full h-full object-cover object-center">
            <!-- Overlay sombre pour améliorer la lisibilité du texte -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        </div>
        
        <!-- Contenu du header -->
        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
            <div class="max-w-3xl text-white">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    CULTURE <span class="text-yellow-400">BENIN</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 leading-relaxed">
                    Promouvoir la culture Béninoise à travers ses différentes œuvres reste l'objectif principal de notre site. 
                    Chaque contenu raconte une histoire unique et témoigne de l'identité des différentes communautés.
                </p>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- CONTENUS AVEC PAGINATION --}}
        @foreach ($contenus as $contenu)
        <div class="bg-white border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 p-8 rounded-2xl mb-8">

            {{-- TYPE DE CONTENU --}}
            <span class="inline-block px-3 py-1 text-xs font-bold text-primary bg-orange-50 rounded-full uppercase tracking-wide">
                {{ $contenu->typeContenu->nom_type_contenu ?? 'Type inconnu' }}
            </span>

            {{-- TITRE --}}
            <h2 class="text-3xl font-bold text-gray-900 mt-3 mb-4">
                {{ $contenu->titre }}
            </h2>

            {{-- DESCRIPTION / TEXTE --}}
            <div class="text-gray-700 text-lg leading-relaxed mb-6">
                <div id="preview-{{ $contenu->id }}">
                    {{ Str::limit($contenu->texte, 100) }}
                    @if(strlen($contenu->texte) > 100)
                        <button onclick="showPaymentModal({{ $contenu->id }})" class="text-primary hover:underline font-medium">Lire la suite...</button>
                    @endif
                </div>
                <div id="full-content-{{ $contenu->id }}" class="hidden">
                    {{ $contenu->texte }}
                </div>
            </div>
            
            {{-- Payment Modal --}}
            <div id="payment-modal-{{ $contenu->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Accéder au contenu complet</h3>
                        <button onclick="closePaymentModal({{ $contenu->id }})" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-gray-700 mb-4">Pour accéder à l'intégralité de ce contenu, veuillez effectuer un paiement de <span class="font-bold">500 FCFA</span>.</p>
                        <div id="payment-form-{{ $contenu->id }}">
                            {{-- FedaPay payment form will be loaded here --}}
                            <button onclick="processPayment({{ $contenu->id }})" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                                Payer maintenant
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-sm text-gray-500">
                        <p>Paiement sécurisé par FedaPay</p>
                    </div>
                </div>
            </div>
            
            {{-- NOTE MOYENNE DU CONTENU --}}
            @if($contenu->commentaires->avg('note'))
            <div class="mb-6 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-gray-700">Note moyenne :</span>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($contenu->commentaires->avg('note')))
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @else
                                <i class="far fa-star text-yellow-400 text-sm"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">({{ number_format($contenu->commentaires->avg('note'), 1) }}/5)</span>
                </div>
            </div>
            @endif
            
            {{-- MEDIAS --}}
            @if ($contenu->medias->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-primary"></i>
                        Médias associés
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($contenu->medias as $media)
                            @php
                                $extension = strtolower(pathinfo($media->chemin, PATHINFO_EXTENSION));
                                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $isVideo = in_array($extension, ['mp4', 'webm', 'ogg']);
                            @endphp

                            <div class="rounded-2xl overflow-hidden bg-white shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group">

                                {{-- IMAGE --}}
                                @if($isImage)
                                    <div class="overflow-hidden">
                                        <img 
                                            src="{{ asset($media->chemin) }}"
                                            alt="{{ $media->description }}"
                                            class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300"
                                        >
                                    </div>
                                @endif

                                {{-- VIDEO --}}
                                @if($isVideo)
                                    <div class="overflow-hidden">
                                        <video controls class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
                                            <source src="{{ asset('storage/'.$media->chemin) }}" type="video/{{ $extension }}">
                                        </video>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- COMMENTAIRES --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-comments mr-2 text-primary"></i>
                    Commentaires récents
                </h3>

                <div class="space-y-4">
                    @forelse ($contenu->commentaires as $commentaire)
                    <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-2xl border border-gray-200 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-900">{{ $commentaire->utilisateur->name  ?? 'Anonyme'}}</span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-xs text-gray-500">
                                    {{ $commentaire->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            {{-- Note moyenne du commentaire --}}
                            @if($commentaire->notes->count() > 0)
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600 mr-1">
                                    ({{ number_format($commentaire->averageNote(), 1) }})
                                </span>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $commentaire->averageNote())
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400 text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                            @endif
                        </div>
                        
                        <div class="text-gray-700 mb-3">{{ $commentaire->texte }}</div>
                        
                        {{-- Formulaire de notation (uniquement pour les autres utilisateurs) --}}
                        @auth
                            @if(auth()->id() !== $commentaire->id_utilisateur)
                            <div class="mt-2 pt-2 border-t border-gray-100">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600 mr-2">Votre note :</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button 
                                                type="button" 
                                                class="comment-note-star text-yellow-400 hover:text-yellow-500 focus:outline-none"
                                                data-comment-id="{{ $commentaire->id }}"
                                                data-note="{{ $i }}"
                                                title="Donner {{ $i }} étoile{{ $i > 1 ? 's' : '' }}"
                                            >
                                                @if($commentaire->userNote(auth()->id()) >= $i)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            </button>
                                        @endfor
                                    </div>
                                    @if($commentaire->userNote(auth()->id()))
                                        <span class="text-xs text-gray-500 ml-2">
                                            (Vous avez noté {{ $commentaire->userNote(auth()->id()) }}/5)
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="mt-2 pt-2 text-sm">
                                <a href="{{ route('author.login') }}" class="text-primary hover:underline">
                                    Connectez-vous pour noter ce commentaire
                                </a>
                            </div>
                        @endauth
                    </div>

                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="far fa-comment-dots text-3xl mb-2"></i>
                            <p>Aucun commentaire pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- FORMULAIRE DE COMMENTAIRES --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-edit mr-2 text-primary"></i>
                    Ajouter un commentaire
                </h3>
                
                @auth
                    @if(auth()->id() !== $contenu->id_auteur)
                    <form action="{{ route('commentaires.store') }}" method="POST" class="space-y-4 note-form" data-contenu="{{ $contenu->id }}">
                        @csrf
                        <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">
                        
                        {{-- NOTE --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note (optionnelle)</label>
                            <div class="flex items-center gap-1 note-container">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="note-star text-2xl text-gray-300 hover:text-yellow-400 transition-colors" data-note="{{ $i }}">
                                        <i class="far fa-star"></i>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="note" class="selected-note" value="0">
                            <span class="text-xs text-gray-500 mt-1 note-text">Cliquez sur les étoiles pour noter</span>
                        </div>

                        {{-- TEXTE DU COMMENTAIRE --}}
                        <textarea name="texte" required rows="4" 
                            placeholder="Partagez vos pensées..."
                            class="w-full px-6 py-4 text-gray-700 bg-white border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none"></textarea>

                        <button type="submit" class="btn-1 inline-flex items-center">
                            <span class="text">Publier le commentaire</span>
                            <div class="circle"></div>
                            <svg class="arr-1" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                            <svg class="arr-2" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                        </button>
                    </form>
                    @else
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Vous ne pouvez pas commenter ou noter votre propre contenu.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="text-center py-6 bg-gray-50 rounded-2xl border border-gray-200">
                        <i class="fas fa-lock text-3xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600 mb-4">Connectez-vous pour ajouter un commentaire</p>
                        <a href="{{ route('author.login') }}" class="btn-1 inline-flex items-center">
                            <span class="text">Se connecter</span>
                            <div class="circle"></div>
                            <svg class="arr-1" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                            <svg class="arr-2" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                        </a>
                    </div>
                @endauth
            </div>

        </div>
        @endforeach

        {{-- PAGINATION DES CONTENUS --}}
        @if($contenus->hasPages())
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                {{-- Previous Page Link --}}
                @if ($contenus->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $contenus->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($contenus->getUrlRange(1, $contenus->lastPage()) as $page => $url)
                    @if ($page == $contenus->currentPage())
                        <span class="px-3 py-2 text-white bg-primary border border-primary rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($contenus->hasMorePages())
                    <a href="{{ $contenus->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        </div>
        @endif

    </div>

    <style>
        .btn-1 {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 32px;
            border: 3px solid transparent;
            font-size: 14px;
            background-color: #000000;
            border-radius: 100px;
            font-weight: 500;
            color: #ffffff;
            box-shadow: 0 0 0 2px #000000;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            text-decoration: none;
        }

        .btn-1 .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 15px;
            height: 15px;
            background-color: #c57e0bff;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            z-index: 1;
        }

        .btn-1 .text {
            position: relative;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            color: #ffffff;
        }

        .btn-1 svg {
            position: absolute;
            width: 18px;
            height: 18px;
            fill: #ffffff;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .arr-1 {
            right: 16px;
            opacity: 1;
        }

        .btn-1 .arr-2 {
            left: -25%;
            opacity: 0;
        }

        .btn-1:hover {
            box-shadow: 0 0 0 8px transparent;
            border-radius: 12px;
            background-color: #000000;
        }

        .btn-1:hover .arr-1 {
            right: -25%;
            opacity: 0;
        }

        .btn-1:hover .arr-2 {
            left: 16px;
            opacity: 1;
        }

        .btn-1:hover .text {
            transform: translateX(8px);
            color: #ffffff;
        }

        .btn-1:hover .circle {
            width: 180px;
            height: 180px;
            opacity: 1;
        }

        .btn-1:active {
            transform: scale(0.95);
            box-shadow: 0 0 0 3px #c57e0bff;
        }

        .dark .btn-1 {
            background-color: #1a1a1a;
            box-shadow: 0 0 0 2px #1a1a1a;
        }

        .dark .btn-1:hover {
            background-color: #1a1a1a;
        }
    </style>

    <script>
        // Système de notation par étoiles
        document.addEventListener('DOMContentLoaded', function() {
            const noteForms = document.querySelectorAll('.note-form');

            noteForms.forEach(form => {
                const stars = form.querySelectorAll('.note-star');
                const hiddenInput = form.querySelector('.selected-note');
                const noteText = form.querySelector('.note-text');

                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const note = parseInt(this.dataset.note);
                        hiddenInput.value = note;

                        // Mise à jour des étoiles
                        stars.forEach((s, idx) => {
                            const icon = s.querySelector('i');
                            icon.className = idx < note ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
                        });

                        // Mise à jour du texte
                        const notes = ['Aucune note', 'Très mauvais', 'Mauvais', 'Moyen', 'Bon', 'Excellent'];
                        noteText.textContent = notes[note];
                    });

                    // Effet hover
                    star.addEventListener('mouseover', function() {
                        const hoverNote = parseInt(this.dataset.note);
                        stars.forEach((s, idx) => {
                            const icon = s.querySelector('i');
                            icon.className = idx < hoverNote ? 'fas fa-star text-yellow-300' : 'far fa-star text-gray-300';
                        });
                    });

                    star.addEventListener('mouseout', function() {
                        const currentNote = parseInt(hiddenInput.value);
                        stars.forEach((s, idx) => {
                            const icon = s.querySelector('i');
                            icon.className = idx < currentNote ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
                        });
                    });
                });
            });
        });
    </script>

    <script>
        // Fonctions pour gérer la modale de paiement
        function showPaymentModal(contenuId) {
            document.getElementById(`payment-modal-${contenuId}`).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal(contenuId) {
            document.getElementById(`payment-modal-${contenuId}`).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Fermer la modale en cliquant en dehors
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Gestion du paiement avec FedaPay
        async function processPayment(contenuId) {
            const paymentButton = document.querySelector(`#payment-form-${contenuId} button`);
            
            // Vérifier si le bouton de paiement existe
            if (!paymentButton) {
                console.error('Bouton de paiement introuvable');
                return;
            }
            
            const originalButtonText = paymentButton.innerHTML;
            
            try {
                // Désactiver le bouton pendant le traitement
                paymentButton.disabled = true;
                paymentButton.innerHTML = 'Traitement en cours...';

                // Récupérer le token CSRF
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                if (!token) {
                    throw new Error('Token CSRF manquant');
                }
                
                // Appeler le backend pour initialiser le paiement
                const response = await fetch('/paiement/initier', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        contenu_id: contenuId,
                        amount: 100, // Montant en FCFA
                        description: `Accès au contenu ${contenuId}`
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Erreur lors de l\'initialisation du paiement');
                }

                // Rediriger vers la page de paiement FedaPay
                if (data.payment_url) {
                    window.location.href = data.payment_url;
                } else {
                    throw new Error('URL de paiement non reçue');
                }

            } catch (error) {
                console.error('Erreur de paiement:', error);
                alert('Une erreur est survenue lors du traitement de votre paiement: ' + error.message);
                
                // Réactiver le bouton en cas d'erreur
                if (paymentButton) {
                    paymentButton.innerHTML = originalButtonText;
                    paymentButton.disabled = false;
                }
            }
        }
        // Vérifier si le paiement a été effectué avec succès (après redirection)
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('payment_success') === '1') {
                const contenuId = urlParams.get('contenu_id');
                if (contenuId) {
                    // Afficher le contenu complet
                    document.getElementById(`preview-${contenuId}`).classList.add('hidden');
                    document.getElementById(`full-content-${contenuId}`).classList.remove('hidden');
                    
                    // Faire défiler jusqu'au contenu
                    document.getElementById(`full-content-${contenuId}`).scrollIntoView({ behavior: 'smooth' });
                }
            }

            // Gestion des clics sur les étoiles de notation des commentaires
            document.querySelectorAll('.comment-note-star').forEach(star => {
                star.addEventListener('click', async function() {
                    const commentId = this.dataset.commentId;
                    const note = this.dataset.note;
                    const starIcons = document.querySelectorAll(`.comment-note-star[data-comment-id="${commentId}"]`);
                    
                    try {
                        const response = await fetch(`/commentaires/${commentId}/notes`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ note: note })
                        });

                        const data = await response.json();

                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // Mettre à jour l'affichage des étoiles
                        starIcons.forEach((s, index) => {
                            const icon = s.querySelector('i');
                            if (index < note) {
                                icon.className = 'fas fa-star';
                                s.classList.add('text-yellow-500');
                            } else {
                                icon.className = 'far fa-star';
                                s.classList.remove('text-yellow-500');
                            }
                        });

                        // Afficher un message de succès
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
                        toast.textContent = 'Votre note a été enregistrée !';
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 3000);

                        // Recharger la page après un court délai pour afficher les mises à jour
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);

                    } catch (error) {
                        console.error('Erreur:', error);
                        alert('Une erreur est survenue lors de l\'enregistrement de votre note.');
                    }
                });
            });
        });
    </script>

</body>
</html>