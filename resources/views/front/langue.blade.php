<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diversité Linguistique du Bénin</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-CxrrfATK.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Space Grotesk', sans-serif;
        }
        
        .langue-card {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .langue-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .search-box {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }
        
        .search-box:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }
        
        .filter-btn {
            transition: all 0.2s ease;
        }
        
        .filter-btn.active {
            background-color: #d4af37;
            color: white;
        }
        
        .add-lang-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .add-lang-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }
        
        .add-lang-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%, -50%);
            transform-origin: 50% 50%;
        }
        
        .add-lang-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(40, 40);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    <!-- En-tête -->
    <x-navbar/>
    <header class="relative h-96 md:h-screen max-h-[800px] overflow-hidden">
        <!-- Image de fond -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/langue-bg.webp') }}" 
                alt="Diversité Linguistique du Bénin" 
                class="w-full h-full object-cover object-center">
            <!-- Overlay avec dégradé pour le texte -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
        </div>
        
        <!-- Contenu du header -->
        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
            <div class="max-w-4xl">
                <span class="block text-[#E2E9C0] text-sm md:text-base font-semibold tracking-wider uppercase mb-4">
                    Exploration Culturelle
                </span>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Diversité <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E2E9C0] to-[#a8b38b]">Linguistique</span>
                </h1>
                
                <div class="w-20 h-1 bg-[#E2E9C0] mb-8 rounded-full"></div>
                
                <p class="text-lg md:text-xl text-gray-100 max-w-2xl leading-relaxed">
                    Découvrez la richesse culturelle à travers les langues du Bénin. Chaque langue raconte une histoire unique et témoigne de l'identité des différentes communautés.
                </p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <!-- Barre de recherche et filtres -->
        <div class="mb-12">
            <div class="mb-6">
                <div class="relative max-w-2xl mx-auto">
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Rechercher une langue..." 
                        class="w-full px-6 py-3 pr-12 rounded-full search-box focus:outline-none bg-white shadow-sm"
                    >
                    <i class="fas fa-search absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button class="filter-btn px-4 py-2 rounded-full bg-white shadow-sm hover:bg-gray-100 active">Toutes</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-white shadow-sm hover:bg-gray-100" data-region="sud">Sud</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-white shadow-sm hover:bg-gray-100" data-region="nord">Nord</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-white shadow-sm hover:bg-gray-100" data-region="centre">Centre</button>
            </div>
        </div>

        <!-- Grille des langues -->
        <div id="languesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
            <!-- Les cartes seront ajoutées dynamiquement ici -->
        </div>
    </main>

    <script>
        // Données des langues (à remplacer par une API plus tard)
        const langues = @json($langues);

        // Éléments du DOM
        const languesGrid = document.getElementById('languesGrid');
        const searchInput = document.getElementById('searchInput');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const addLangBtn = document.getElementById('addLangBtn');
        const addLangModal = document.getElementById('addLangModal');
        const closeModal = document.getElementById('closeModal');
        const langForm = document.getElementById('langForm');

        // Afficher les langues
        function displayLangues(languesToShow) {
            languesGrid.innerHTML = languesToShow.map(langue => `
                <div class="langue-card" data-region="non-specifiee">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold  bg-yellow-100 text-yellow-800 rounded-full">${langue.nom} ${langue.code || ''}</h3>
                    </div>
                    <p class="text-gray-600 mb-4">${langue.description || 'Aucune description disponible.'}</p>
                </div>
            `).join('');
        }

        /*// Filtrer les langues
        function filterLangues() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeFilter = document.querySelector('.filter-btn.active').dataset.region || 'all';
            
            const filtered = langues.filter(langue => {
                const matchesSearch = langue.nom.toLowerCase().includes(searchTerm) || 
                                    langue.description.toLowerCase().includes(searchTerm);
                const matchesFilter = activeFilter === 'all' || langue.region === activeFilter;
                return matchesSearch && matchesFilter;
            });
            
            displayLangues(filtered);
        } */

        // Gestionnaires d'événements
        //searchInput.addEventListener('input', filterLangues);
        
        /*filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                filterLangues();
            });
        }); */

        /* // Gestion du modal
        addLangBtn.addEventListener('click', () => {
            addLangModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        closeModal.addEventListener('click', () => {
            addLangModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        // Soumission du formulaire
        langForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const nom = document.getElementById('langName').value;
            const region = document.getElementById('langRegion').value;
            const description = document.getElementById('langDesc').value;
            
            if (nom && region && description) {
                // Ici, vous pourriez envoyer les données à un serveur
                alert(`Langue "${nom}" ajoutée avec succès !`);
                langForm.reset();
                addLangModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Fermer le modal en cliquant en dehors
        window.addEventListener('click', (e) => {
            if (e.target === addLangModal) {
                addLangModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }); */

        // Afficher toutes les langues au chargement
        displayLangues(langues);

        // Filtrage par mot-clé dans les cartes
        const langueCardsContainer = document.getElementById('languesGrid');

        searchInput.addEventListener('input', () => {
            const keyword = searchInput.value.toLowerCase();
            const cards = langueCardsContainer.querySelectorAll('.langue-card');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(keyword)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Retirer la classe active de tous les boutons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const regionKeyword = button.dataset.region ? button.dataset.region.toLowerCase() : '';

                // Filtrer le tableau de langues
                const filtered = langues.filter(langue => {
                    const text = (langue.nom + ' ' + (langue.description || '')).toLowerCase();
                    // Si "Toutes", on affiche tout
                    if (!regionKeyword) return true;
                    return text.includes(regionKeyword);
                });

                // Afficher les cartes filtrées
                displayLangues(filtered);

                // Reset recherche si nécessaire
                searchInput.value = '';
            });
        });

    </script>
</body>
</html>