<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourisme au Bénin | Découvrez la Perce de l'Afrique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: white;
            color: #fff;
            overflow-x: hidden;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            position: relative;
            color: #fff;
        }

        .section-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #c57e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(197, 126, 11, 0.1);
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(197, 126, 11, 0.2);
            border-color: rgba(197, 126, 11, 0.3);
        }

        .gradient-text {
            background: linear-gradient(45deg, #c57e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .swiper {
            width: 100%;
            padding: 50px 0;
        }

        /* NOUVELLE CLASSE POUR LE DESIGN HERO DESTINATION */
        .destinations-swiper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .destination-hero {
            position: relative;
            min-height: 700px; /* Hauteur minimale pour que l'image soit visible */
            width: 100%;
            overflow: hidden;
        }

        .destination-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0; /* L'image est en arrière-plan */
        }

        .overlay-card {
            background-color: rgba(0, 0, 0, 0.85); /* Fond noir semi-transparent */
            backdrop-filter: blur(8px);
            z-index: 10;
            /* Style pour Desktop */
            position: absolute;
            top: 10%;
            right: 5%;
            width: 90%; /* Par défaut, prend 90% sur mobile */
            max-width: 500px; /* Limite la taille sur grand écran */
            padding: 40px;
            border-radius: 12px;
            border-left: 5px solid #fbbf24; /* Ajout d'une barre jaune */
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* MEDIA QUERY pour aligner l'overlay à droite sur Desktop */
        @media (min-width: 1024px) {
            .overlay-card {
                width: 40%;
                right: 100px; /* Marge à droite */
            }
        }

        .culture-badge {
            background: linear-gradient(45deg, #c57e0b, #fbbf24);
            color: #1e293b;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: linear-gradient(45deg, #c57e0b, transparent);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 3rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(45deg, #c57e0b, #fbbf24);
        }

        .timeline-dot {
            position: absolute;
            left: -6px;
            top: 0;
            width: 15px;
            height: 15px;
            background: #c57e0b;
            border-radius: 50%;
            border: 3px solid #1e293b;
        }

        .food-card {
            background: rgba(30, 41, 59, 0.6);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .food-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(197, 126, 11, 0.3);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #c57e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .parallax-section {
            background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.9)), 
                        url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 100px 0;
        }

        /* Style personnalisé pour les flèches de navigation */
        .swiper-button-next,
        .swiper-button-prev {
            color: #c57e0b; /* Couleur jaune-or */
            background: rgba(255, 255, 255, 0.8);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        /* Styles spécifiques pour les boutons de navigation des hébergements */
        #hebergements .swiper-button-next,
        #hebergements .swiper-button-prev {
            color: #1e293b; /* Couleur foncée pour un meilleur contraste sur fond clair */
            background: rgba(255, 255, 255, 0.9);
        }

        #hebergements .swiper-button-next:hover,
        #hebergements .swiper-button-prev:hover {
            background: white;
            transform: scale(1.1);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: white;
            transform: scale(1.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 24px;
            font-weight: bold;
        }

        .swiper-button-prev {
            left: 30px;
        }

        .swiper-button-next {
            right: 30px;
        }

        /* Style pour la pagination */
        .swiper-pagination-bullet {
            background: white;
            opacity: 0.5;
            width: 10px;
            height: 10px;
            margin: 0 5px;
        }

        .swiper-pagination-bullet-active {
            background: #fbbf24;
            opacity: 1;
            transform: scale(1.2);
        }

        /* Styles pour la section Hébergements */
        .hebergements-swiper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hebergement-hero {
            position: relative;
            min-height: 700px;
            width: 100%;
            overflow: hidden;
        }

        .hebergement-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .overlay-card-hebergement {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            z-index: 10;
            position: relative;
            width: 100%;
            max-width: 600px;
            padding: 40px;
            border-radius: 12px;
            border-left: 5px solid #fbbf24;
            animation: slideInRight 0.8s ease-out;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            color: #1e293b;
        }

        /* Ajustements pour les écrans plus petits */
        @media (max-width: 1024px) {
            .overlay-card-hebergement {
                max-width: 100%;
                margin: 20px;
                padding: 30px;
            }
            
            .hebergement-hero {
                min-height: 600px;
            }
        }

        @media (max-width: 768px) {
            .overlay-card-hebergement {
                padding: 20px;
                margin: 10px;
            }
            
            .hebergement-hero {
                min-height: 500px;
            }
        }
        </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <x-navbar/>
        <div class="floating-shapes">
            <div class="shape w-20 h-20 top-20 left-10"></div>
            <div class="shape w-32 h-32 bottom-40 right-20 animation-delay-2000"></div>
            <div class="shape w-16 h-16 top-1/2 left-1/4 animation-delay-4000"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-6xl md:text-8xl font-bold mb-6">
                <span class="gradient-text">BÉNIN</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                Berceau du Vodoun, terre des rois et des traditions ancestrales. 
                Découvrez l'authenticité africaine dans toute sa splendeur.
            </p>
        </div>
    </section>

    <!-- Histoire du Bénin -->
    <section id="histoire" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="section-title text-center mb-16">Histoire & Patrimoine</h2>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="culture-badge inline-block mb-4">Patrimoine UNESCO</div>
                    <h3 class="text-4xl font-bold text-black mb-6">Le Royaume du Danhomè</h3>
                    <p class="text-black text-lg leading-relaxed mb-6">
                        Ancien royaume africain qui a marqué l'histoire de la région du XVIIe au XIXe siècle. 
                        Connu pour son organisation militaire, ses palais royaux et sa riche culture, le Danhomè 
                        est classé au patrimoine mondial de l'UNESCO.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <h4 class="text-xl font-semibold text-black mb-2">1625 - Fondation</h4>
                            <p class="text-black">Création du royaume par le roi Houégbadja</p>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <h4 class="text-xl font-semibold text-black mb-2">1894 - Colonisation</h4>
                            <p class="text-black">Le Bénin devient colonie française sous le nom de Dahomey</p>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <h4 class="text-xl font-semibold text-black mb-2">1960 - Indépendance</h4>
                            <p class="text-black">Accession à l'indépendance le 1er août 1960</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <img src="{{asset('images/abomey.png')}}" 
                         alt="Palais royaux d'Abomey" 
                         class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Section d'introduction améliorée -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <!-- En-tête avec animation -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Terre d'<span style="background: linear-gradient(45deg, #E2E9C0, #a8b38b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">accueil</span> et de découvertes
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Le Bénin vous accueille à bras ouverts ! Sa culture de l'hospitalité est ancrée dans ses traditions, 
                    offrant aux visiteurs une expérience chaleureuse, authentique et inoubliable.
                </p>
            </div>
            
            <!-- Cartes améliorées -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Carte 1 - Richesses culturelles -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-400 hover:translate-y-[-10px] hover:shadow-2xl hover:border-[#E2E9C0]/50">
                    <div class="p-8">
                        <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center rounded-full bg-[#E2E9C0] mb-6 mx-auto" style="animation: float 6s ease-in-out infinite;">
                            <i class="fas fa-landmark text-2xl text-gray-800"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Richesses Culturelles</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le Bénin, terre d'une culture riche et d'un art vibrant, est une destination idéale 
                            pour les voyageurs en quête de découvertes authentiques et inspirantes.
                        </p>
                        <div class="flex items-center justify-center text-[#E2E9C0] font-semibold">
                            <span>Découvrir</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-[#E2E9C0]/20 to-transparent h-1.5 w-full"></div>
                </div>
                
                <!-- Carte 2 - Hospitalité légendaire -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-400 hover:translate-y-[-10px] hover:shadow-2xl hover:border-[#E2E9C0]/50">
                    <div class="p-8">
                        <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center rounded-full bg-[#E2E9C0] mb-6 mx-auto" style="animation: float 6s ease-in-out 0.5s infinite;">
                            <i class="fas fa-hands-helping text-2xl text-gray-800"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Hospitalité Légendaire</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Découvrez l'accueil chaleureux des Béninois, réputé dans toute l'Afrique de l'Ouest, 
                            qui fera de votre séjour une expérience humaine inoubliable.
                        </p>
                        <div class="flex items-center justify-center text-[#E2E9C0] font-semibold">
                            <span>Rencontrer</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-[#E2E9C0]/20 to-transparent h-1.5 w-full"></div>
                </div>
                
                <!-- Carte 3 - Diversité des paysages -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-400 hover:translate-y-[-10px] hover:shadow-2xl hover:border-[#E2E9C0]/50">
                    <div class="p-8">
                        <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center rounded-full bg-[#E2E9C0] mb-6 mx-auto" style="animation: float 6s ease-in-out 1s infinite;">
                            <i class="fas fa-mountain text-2xl text-gray-800"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Diversité des Paysages</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le Bénin offre une grande variété de paysages, une destination parfaite 
                            pour les voyageurs en quête de diversité et d'aventures inoubliables.
                        </p>
                        <div class="flex items-center justify-center text-[#E2E9C0] font-semibold">
                            <span>Explorer</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-[#E2E9C0]/20 to-transparent h-1.5 w-full"></div>
                </div>
            </div>

            <!-- Citation inspirante -->
            <div class="mt-16 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="text-5xl md:text-6xl text-[#E2E9C0] mb-2">"</div>
                    <blockquote class="text-xl md:text-2xl italic text-gray-700 mb-4 md:mb-6">
                        Au Bénin, chaque visiteur devient un ami, chaque découverte devient un souvenir précieux
                    </blockquote>
                </div>
            </div>
        </div>
        
        <!-- Animation keyframes -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
        </style>
    </section>

    <!-- Grandes Destinations -->
    <section id="destinations" class="py-0 bg-slate-900">
        <div class="destinations-swiper swiper-container max-w-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 - Porto-Novo -->
                <div class="swiper-slide">
                    <div class="destination-hero max-w-full mx-auto">
                        <img src="{{asset('images/porto-novo.webp')}}" 
                             alt="Grande Mosquée de Porto-Novo, Bénin" 
                             class="destination-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card my-12 lg:my-0">
                                <p class="text-yellow-400 font-semibold uppercase text-sm mb-2">
                                    Quelques incontournables au Bénin
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                                    Porto-Novo, la capitale du Bénin
                                </h2>
                                
                                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                    Porto-Novo, la capitale béninoise, est une véritable perle culturelle et historique
                                    qui mérite une place de choix sur tout itinéraire touristique. C'est une immersion
                                    dans l'histoire en visitant des lieux emblématiques comme le Musée Alexandre Sènou Adandé, 
                                    la Grande Mosquée mythique et le Palais du roi Toffa 1er.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 - Ouidah -->
                <div class="swiper-slide">
                    <div class="destination-hero max-w-full mx-auto">
                        <img src="{{asset('images/pnr.png')}}" 
                             alt="Route des Esclaves, Ouidah" 
                             class="destination-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card my-12 lg:my-0">
                                <p class="text-yellow-400 font-semibold uppercase text-sm mb-2">
                                    Patrimoine Mondial de l'UNESCO
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                                    Ouidah, la cité historique
                                </h2>
                                
                                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                    Ouidah, classée au patrimoine mondial de l'UNESCO, est une ville chargée d'histoire,
                                    connue pour son rôle dans la traite négrière. Découvrez la Porte du Non-Retour, 
                                    le Temple des Pythons et la Route des Esclaves. Imprégnez-vous de l'atmosphère unique 
                                    de cette ville où se mêlent histoire, culture et spiritualité vaudou.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Parc de la Pendjari -->
                <div class="swiper-slide">
                    <div class="destination-hero max-w-full mx-auto">
                        <img src="{{asset('images/pendjari.png')}}" 
                             alt="Parc National de la Pendjari" 
                             class="destination-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card my-12 lg:my-0">
                                <p class="text-yellow-400 font-semibold uppercase text-sm mb-2">
                                    Réserve de biosphère UNESCO
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                                    Parc National de la Pendjari
                                </h2>
                                
                                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                    Dernier refuge de la faune ouest-africaine, le Parc National de la Pendjari est un joyau 
                                    de biodiversité. Partez pour un safari inoubliable à la rencontre des éléphants, lions, 
                                    buffles et de nombreuses espèces d'antilopes. Un écosystème préservé qui offre des paysages 
                                    à couper le souffle, des chutes d'eau spectaculaires et une expérience nature authentique.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 - Ganvié -->
                <div class="swiper-slide">
                    <div class="destination-hero max-w-full mx-auto">
                        <img src="{{asset('images/photo-ganvie.png')}}" 
                             alt="Village Lacustre de Ganvié, Bénin" 
                             class="destination-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card my-12 lg:my-0">
                                <p class="text-yellow-400 font-semibold uppercase text-sm mb-2">
                                    La Venise de l'Afrique
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                                    Ganvié, la cité lacustre
                                </h2>
                                
                                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                    Ganvié, surnommée la "Venise de l'Afrique", est une cité lacustre unique au monde,
                                    construite sur pilotis au milieu du lac Nokoué. Découvrez ce site classé au patrimoine
                                    mondial de l'UNESCO, où la vie s'organise autour des canaux. Naviguez entre les maisons
                                    sur pilotis, le marché flottant et les fermes piscicoles pour une expérience inoubliable.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 - Abomey -->
                <div class="swiper-slide">
                    <div class="destination-hero max-w-full mx-auto">
                        <img src="{{asset('images/abomey.png')}}" 
                             alt="Palais Royal d'Abomey, Bénin" 
                             class="destination-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card my-12 lg:my-0">
                                <p class="text-yellow-400 font-semibold uppercase text-sm mb-2">
                                    Patrimoine Mondial de l'UNESCO
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                                    Abomey, la cité royale
                                </h2>
                                
                                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                                    Ancienne capitale du royaume du Dahomey, Abomey est un haut lieu de l'histoire béninoise.
                                    Visitez les majestueux palais royaux classés au patrimoine mondial de l'UNESCO,
                                    découvrez le musée historique et les impressionnantes bas-reliefs racontant l'histoire
                                    des rois du Dahomey. Une plongée fascinante dans l'ère des grands royaumes africains.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Gastronomie -->
    <section id="gastronomie" class="py-20 bg-yellow-100">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="section-title text-center mb-16">Saveurs du Bénin</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <style>
                    .food-card {
                        height: 100%;
                        display: flex;
                        flex-direction: column;
                    }
                    .food-card > div:first-child {
                        height: 300px; /* Hauteur augmentée */
                        width: 100%;
                    }
                    .food-card img {
                        height: 100%;
                        width: 100%;
                        object-fit: cover;
                    }
                </style>
                <!-- Plat 1 -->
                <div class="food-card group">
                    <div class="bg-overlay bg-cover bg-center w-full" 
                         style="background-image: url('{{ asset('images/igname.jpg') }}')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Pâte d'Igname</h3>
                        <p class="text-gray-300 mb-4">Plat traditionnel à base d'igname pilée, servi avec des sauces variées</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-400 font-semibold">⭐ Plat National</span>
                            <span class="culture-badge text-sm">Populaire</span>
                        </div>
                    </div>
                </div>

                <!-- Plat 2 -->
                <div class="food-card group">
                    <div class="bg-overlay bg-cover bg-center w-full" 
                         style="background-image: url('{{ asset('images/akassa.jpg') }}')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Akassa</h3>
                        <p class="text-gray-300 mb-4">Bouillie de maïs fermenté, souvent accompagnée de sauce gombo</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-400 font-semibold">⭐ Spécialité</span>
                            <span class="culture-badge text-sm">Traditionnel</span>
                        </div>
                    </div>
                </div>

                <!-- Plat 3 -->
                <div class="food-card group">
                    <div class="bg-overlay bg-cover bg-center w-full" 
                         style="background-image: url('{{ asset('images/atassi.jpg') }}')">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Atassi</h3>
                        <p class="text-gray-300 mb-4">Mélange esquis de riz + Haricot + Friture</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-400 font-semibold">⭐ Festif</span>
                            <span class="culture-badge text-sm">Moderne</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hébergements -->
    <section id="hebergements" class="py-0 bg-white">
        <div class="hebergements-swiper swiper-container max-w-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 - Sofitel Hôtel -->
                <div class="swiper-slide">
                    <div class="hebergement-hero max-w-full mx-auto">
                        <img src="{{asset('images/sofitel-cotonou_012.jpg')}}" 
                             alt="Sofitel Hôtel, Bénin" 
                             class="hebergement-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card-hebergement my-12 lg:my-0">
                                <p class="text-yellow-500 font-semibold uppercase text-sm mb-2">
                                    Hôtel 5 Étoiles
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                                    Sofitel Cotonou
                                </h2>
                                
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Le Sofitel Cotonou incarne l'excellence et l'élégance française au cœur de la capitale économique du Bénin. 
                                    Profitez d'un service raffiné, de chambres luxueuses et d'équipements haut de gamme.
                                </p>
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Spa</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Piscine</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Restaurant</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Centre d'affaires</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-yellow-500 font-semibold text-lg mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </span>
                                        <span class="text-gray-700 font-semibold">4.9/5</span>
                                    </div>
                                    <div class="bg-yellow-500 text-white px-4 py-2 rounded-full font-bold">
                                        À partir de 120.000 FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 - Novotel Hôtel -->
                <div class="swiper-slide">
                    <div class="hebergement-hero max-w-full mx-auto">
                        <img src="{{asset('images/novotel.jpeg')}}" 
                             alt="Novotel Hôtel, Bénin" 
                             class="hebergement-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card-hebergement my-12 lg:my-0">
                                <p class="text-yellow-500 font-semibold uppercase text-sm mb-2">
                                    Hôtel 4 Étoiles
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                                    Novotel Cotonou Orisha
                                </h2>
                                
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Situé en bord de mer, le Novotel Cotonou Orisha offre un cadre idyllique avec une vue imprenable sur l'océan Atlantique. 
                                    Idéal pour les voyageurs d'affaires et les touristes en quête de confort et de modernité.
                                </p>
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Plage privée</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Piscine</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Wi-Fi gratuit</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Salle de sport</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-yellow-500 font-semibold text-lg mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </span>
                                        <span class="text-gray-700 font-semibold">4.7/5</span>
                                    </div>
                                    <div class="bg-yellow-500 text-white px-4 py-2 rounded-full font-bold">
                                        À partir de 85.000 FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 - Oft resort hotel -->
                <div class="swiper-slide">
                    <div class="hebergement-hero max-w-full mx-auto">
                        <img src="{{asset('images/resort.jpg')}}" 
                             alt="Oft resort hotel, Bénin" 
                             class="hebergement-image" 
                             loading="lazy">
                        
                        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-end">
                            <div class="overlay-card-hebergement my-12 lg:my-0">
                                <p class="text-yellow-500 font-semibold uppercase text-sm mb-2">
                                    Immersion Nature
                                </p>
                                
                                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                                    Oft Resort Hotel
                                </h2>
                                
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Vivez une expérience unique en plein cœur de Ouidah, 
                                    Optez pour une ambiance paradisiaque et profitez d'un hébergement éco-responsable.
                                </p>
                                
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Safari</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Éco-responsable</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Restaurant local</span>
                                    <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Guide naturaliste</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span class="text-yellow-500 font-semibold text-lg mr-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                        <span class="text-gray-700 font-semibold">4.5/5</span>
                                    </div>
                                    <div class="bg-yellow-500 text-white px-4 py-2 rounded-full font-bold">
                                        À partir de 45.000 FCFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        // Attendre que le DOM soit entièrement chargé
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du swiper des destinations
            const destinationsSwiper = new Swiper('#destinations .destinations-swiper', {
                // Configuration de base
                init: true,
                speed: 1000,
                loop: true,
                observer: true,
                observeParents: true,
                observeSlideChildren: true,
                
                // Effet de transition
                effect: 'slide',
                
                // Autoplay
                autoplay: {
                    delay: 7000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                },
                
                // Pagination
                pagination: {
                    el: '#destinations .swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                    dynamicBullets: true,
                    dynamicMainBullets: 3
                },
                
                // Navigation
                navigation: {
                    nextEl: '#destinations .swiper-button-next',
                    prevEl: '#destinations .swiper-button-prev',
                },
                
                // Clavier
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Événements
                on: {
                    init: function() {
                        console.log('Swiper Destinations initialisé avec succès');
                    },
                    slideChange: function() {
                        console.log('Slide Destinations changée');
                    }
                }
            });

            // Initialisation du swiper des hébergements
            const hebergementsSwiper = new Swiper('#hebergements .hebergements-swiper', {
                // Configuration de base
                init: true,
                speed: 1000,
                loop: true,
                observer: true,
                observeParents: true,
                observeSlideChildren: true,
                
                // Effet de transition
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                
                // Autoplay
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                },
                
                // Pagination
                pagination: {
                    el: '#hebergements .swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                    dynamicBullets: true,
                    dynamicMainBullets: 3
                },
                
                // Navigation
                navigation: {
                    nextEl: '#hebergements .swiper-button-next',
                    prevEl: '#hebergements .swiper-button-prev',
                },
                
                // Clavier
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Événements
                on: {
                    init: function() {
                        console.log('Swiper initialisé avec succès');
                    },
                    slideChange: function() {
                        console.log('Slide changée');
                    }
                }
            });
            
            // Forcer la mise à jour du Swiper après le chargement des images
            window.addEventListener('load', function() {
                hebergementsSwiper.update();
                hebergementsSwiper.slideTo(0);
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observer les éléments à animer
        document.querySelectorAll('.card-hover, .food-card, .timeline-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>