<!--?php include_once("includes/header.php"); ? -->
<!-- ?php include_once("includes/navbar.php"); ? -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCUEIL</title>
    <!--link rel="icon" type="image/svg+xml" href="assets/favicon/favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="shortcut icon" href="assets/favicon/favicon.ico" -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .fade-in-left {
            animation: fadeInLeft 1.5s ease-out forwards;
        }
        
        :root {
            --primary: #302F2F;
            --secondary: #E2E9C0;
            --dark: #1A1A1A;
            --light: #F5F5F5;
        }   
        
        html {
            scroll-behavior: smooth;
        }
        
        .hero-title {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }
        
        .hover-scale {
            transition: transform 0.5s cubic-bezier(0.25, 0.45, 0.45, 0.95);
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Style personnalisé pour les flèches de navigation */
.swiper-button-next,
.swiper-button-prev {
    color: #c57e0bff; /* Couleur primaire dorée */
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 8px 25px rgba(197, 126, 11, 0.15),
        0 2px 8px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 1px solid rgba(197, 126, 11, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: linear-gradient(135deg, #c57e0bff 0%, #d4a017 100%);
    color: white;
    transform: scale(1.15) translateY(-2px);
    box-shadow: 
        0 12px 35px rgba(197, 126, 11, 0.25),
        0 4px 15px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.swiper-button-next:active,
.swiper-button-prev:active {
    transform: scale(1.05) translateY(0);
    transition: transform 0.1s ease;
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
    font-weight: 900;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

/* Positionnement amélioré des flèches */
.swiper-button-next {
    right: 20px;
}

.swiper-button-prev {
    left: 20px;
}

/* Container principal */
.swiper-container {
    padding: 30px 0 80px;
    position: relative;
}

/* Effet de surbrillance autour du container */
.swiper-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: -20px;
    right: -20px;
    bottom: 0;
    background: linear-gradient(90deg, 
        rgba(197, 126, 11, 0.03) 0%, 
        transparent 20%, 
        transparent 80%, 
        rgba(197, 126, 11, 0.03) 100%);
    pointer-events: none;
    z-index: 1;
}

/* Slides améliorées */
.swiper-slide {
    width: auto;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transform-origin: center;
    position: relative;
}

/* Effet au survol des slides */
.swiper-slide:hover {
    transform: translateY(-8px) scale(1.02);
    z-index: 10;
}

/* État actif de la slide */
.swiper-slide-active {
    transform: scale(1.05);
    z-index: 5;
}

/* Style personnalisé pour la pagination */
.swiper-pagination {
    bottom: 25px !important;
}

.swiper-pagination-bullet {
    width: 8px;
    height: 8px;
    background: #cbd5e1;
    opacity: 0.6;
    transition: all 0.3s ease;
    margin: 0 6px !important;
    border-radius: 4px;
}

.swiper-pagination-bullet:hover {
    background: #94a3b8;
    opacity: 0.8;
    transform: scale(1.2);
}

.swiper-pagination-bullet-active {
    background: linear-gradient(135deg, #c57e0bff 0%, #d4a017 100%);
    opacity: 1;
    width: 24px;
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(197, 126, 11, 0.3);
}

/* Barre de progression */
.swiper-pagination-progressbar {
    background: rgba(197, 126, 11, 0.1);
    height: 3px;
}

.swiper-pagination-progressbar-fill {
    background: linear-gradient(90deg, #c57e00bff 0%, #d4a017 100%);
}

/* Scrollbar personnalisée */
.swiper-scrollbar {
    background: rgba(197, 126, 11, 0.1);
    border-radius: 10px;
    height: 6px;
    bottom: 10px !important;
}

.swiper-scrollbar-drag {
    background: linear-gradient(90deg, #c57e0bff 0%, #d4a017 100%);
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(197, 126, 11, 0.3);
}

/* Effets de lumière sur les bords */
.swiper-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(197, 126, 11, 0.1) 20%, 
        rgba(197, 126, 11, 0.1) 80%, 
        transparent 100%);
    pointer-events: none;
    z-index: 2;
}

/* Animation d'entrée pour les slides */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

.swiper-slide {
    animation: slideIn 0.6s ease-out;
}

/* Variantes de couleurs pour différents swipers */
.swiper-primary .swiper-button-next,
.swiper-primary .swiper-button-prev {
    background: linear-gradient(135deg, #c57e0bff 0%, #d4a017 100%);
    color: white;
}

.swiper-dark .swiper-button-next,
.swiper-dark .swiper-button-prev {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #c57e0bff;
    border: 1px solid rgba(197, 126, 11, 0.3);
}

/* États désactivés */
.swiper-button-disabled {
    opacity: 0.4 !important;
    transform: scale(0.9);
    cursor: not-allowed;
}

.swiper-button-disabled:hover {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
    color: #c57e0bff !important;
    transform: scale(0.9) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .swiper-button-next,
    .swiper-button-prev {
        width: 44px;
        height: 44px;
        transform: scale(0.9);
    }
    
    .swiper-button-next {
        right: 10px;
    }
    
    .swiper-button-prev {
        left: 10px;
    }
    
    .swiper-container {
        padding: 20px 0 60px;
    }
    
    .swiper-slide:hover {
        transform: translateY(-4px) scale(1.01);
    }
}

@media (max-width: 480px) {
    .swiper-button-next,
    .swiper-button-prev {
        width: 40px;
        height: 40px;
        transform: scale(0.8);
    }
    
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 16px;
    }
    
    .swiper-pagination-bullet {
        width: 6px;
        height: 6px;
        margin: 0 4px !important;
    }
    
    .swiper-pagination-bullet-active {
        width: 20px;
    }
}

/* Effet de parallaxe amélioré */
.swiper-parallax .swiper-slide {
    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* Mode sombre */
@media (prefers-color-scheme: dark) {
    .swiper-button-next,
    .swiper-button-prev {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        color: #c57e0bff;
        border: 1px solid rgba(197, 126, 11, 0.3);
        box-shadow: 
            0 8px 25px rgba(0, 0, 0, 0.3),
            0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: linear-gradient(135deg, #c57e0bff 0%, #d4a017 100%);
        color: #1a1a1a;
    }
    
    .swiper-container::before {
        background: linear-gradient(90deg, 
            rgba(197, 126, 11, 0.05) 0%, 
            transparent 20%, 
            transparent 80%, 
            rgba(197, 126, 11, 0.05) 100%);
    }
}

/* Animation de chargement */
.swiper-loading .swiper-slide {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

/* Effet de brillance sur les flèches */
.swiper-button-next::before,
.swiper-button-prev::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.4) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.swiper-button-next:hover::before,
.swiper-button-prev:hover::before {
    opacity: 1;
}
        
        .scroll-gallery {
            scrollbar-width: none;
        }
        
        .scroll-gallery::-webkit-scrollbar {
            display: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 1s ease forwards;
        }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
    </style>
</head>
<body class="bg-[#fdfdfd] text-gray-800 font-['Space_Grotesk',sans-serif] antialiased">

    <x-navbar />
    <!-- Section Héro avec effet de verre amélioré -->
    <section class="relative min-h-screen flex items-center justify-center px-6 py-32 overflow-hidden">
        <!-- Video background optionnel -->
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop class="w-full h-full object-cover">
                <source src="{{ asset('videos/bg.MOV') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        </div>
        
        <div class="relative z-10 w-full max-w-6xl px-8 py-16 md:px-16">
            <div class="fade-in-left" style="animation: fadeInLeft 1.5s ease-out forwards;">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-8 text-white leading-tight">
                    Découvrez <span class="text-yellow-600">Un monde</span><br>de Splendeurs
                </h1>
                <p class="text-2xl md:text-3xl text-white font-light mb-12 leading-relaxed max-w-2xl opacity-0 animate-fadeIn" style="animation-delay: 0.5s;">
                    Plongez au cœur d'une terre millénaire où histoire, culture et nature se rencontrent pour créer une expérience inoubliable.
                </p>
            </div>
        </div>
        
        <style>
            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            .animate-fadeIn {
                animation: fadeIn 1.5s ease-out forwards;
            }
            @keyframes fadeIn {
                to {
                    opacity: 1;
                }
            }
        </style>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <a href="#histoire" class="text-white text-4xl">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Section Histoire -->
    <section id="histoire" class="py-24 bg-yellow-50">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="relative group animate-fadeIn delay-100">
                <img src="{{asset('images/Photo 13 FM.jpg')}}" alt="Histoire du Bénin" 
                     class="rounded-2xl shadow-xl hover-scale group-hover:shadow-2xl">
                <div class="absolute -inset-4 border-2 border-yellow-400 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            
            <div class="animate-fadeIn delay-200">
                <span class="text-yellow-700 font-semibold">Notre Héritage</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title">L'Histoire Fascinante du Bénin</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Berceau des anciens royaumes de Dahomey et de Porto-Novo, le Bénin regorge de récits épiques et de traditions séculaires. Des palais royaux d'Abomey aux vestiges de Ouidah, chaque pierre raconte une histoire.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <span class="color: --secondary mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>12ème siècle : Émergence des premiers royaumes</span>
                    </li>
                    <li class="flex items-start">
                        <span class="color: --secondary mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>17ème siècle : Apogée du royaume du Dahomey</span>
                    </li>
                    <li class="flex items-start">
                        <span class="color: --secondary mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>1960 : Indépendance du Bénin</span>
                    </li>
                </ul>
                <a href="#" class="inline-flex items-center text-yellow-700 hover:text-yellow-700 font-medium">
                    En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Culture -->
    <section id="culture" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="order-2 md:order-1 animate-fadeIn delay-200">
                <span class="text-yellow-700 font-semibold">Notre Identité</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title">Une Culture Vivante et Envoûtante</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Le Bénin est le berceau du Vodoun, classé au patrimoine mondial de l'UNESCO. Ses festivals colorés, ses danses traditionnelles et son artisanat unique en font une destination culturelle incontournable.
                </p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-2xl mb-2"><i class="fas fa-music"></i></div>
                        <h4 class="font-semibold">Festivals</h4>
                        <p class="text-sm text-gray-600">Vibrants et spirituels</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-2xl mb-2"><i class="fas fa-hands"></i></div>
                        <h4 class="font-semibold">Artisanat</h4>
                        <p class="text-sm text-gray-600">Savoir-faire ancestral</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-2xl mb-2"><i class="fas fa-utensils"></i></div>
                        <h4 class="font-semibold">Cuisine</h4>
                        <p class="text-sm text-gray-600">Saveurs authentiques</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-2xl mb-2"><i class="fas fa-mask"></i></div>
                        <h4 class="font-semibold">Traditions</h4>
                        <p class="text-sm text-gray-600">Transmis depuis des siècles</p>
                    </div>
                </div>
            </div>
            
            <div class="relative group order-1 md:order-2 animate-fadeIn delay-100">
                <img src="{{asset('images/Photo 1 FM.jpg')}}" alt="Culture" 
                     class="rounded-2xl shadow-xl hover-scale group-hover:shadow-2xl">
                <div class="absolute -inset-4 border-2 border-yellow-400 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
        </div>
    </section>

    <!-- Section Lieux -->
    <section id="explore" class="py-24 bg-yellow-50">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center max-w-2xl mx-auto mb-16 animate-fadeIn">
                <span class="text-yellow-700 font-semibold">Explorer</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-3 mb-6">Lieux d'Exception</h2>
                <p class="text-gray-600 text-lg md:text-xl">Découvrez les trésors cachés et les joyaux culturels du Bénin à travers nos sélections exclusives.</p>
            </div>

            <!-- Swiper Container -->
            <div class="relative">
                <div class="swiper-container">
                    <div class="swiper-wrapper pb-12">
                        <?php 
                        $landmarks = [
                            ["Art contemporain du Bénin", "Ouidah", "images/EXPO.jpg"],
                            ["Palais Royal d'Abomey", "Abomey", "images/abomey.png"],
                            ["Parc National de la Pendjari", "Atacora", "images/pendjari.png"],
                            ["Ganvié", "La Cité Lacustre du Bénin", "images/photo-ganvie.png"],
                            ["Porte du non retour", "Ouidah", "images/pnr.png"]
                        ];
                        
                        foreach($landmarks as $landmark): ?>
                            <div class="swiper-slide">
                                <div class="h-96 rounded-2xl overflow-hidden shadow-lg card-hover relative group mx-2">
                                    <img src="{{ asset($landmark[2]) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                                        <h3 class="text-2xl font-bold text-white mb-1"><?= $landmark[0] ?></h3>
                                        <p class="text-yellow-300 font-medium"><?= $landmark[1] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                centeredSlides: true,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            });
        });
    </script>

    <!-- Section Statistiques Animées -->
    <section class="py-24 bg-gradient-to-br from-[color:var(--primary)] to-[color:var(--secondary)] text-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 animate-fadeIn">
                <span class="text-yellow-300 font-semibold">En Chiffres</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title mx-auto">Le Bénin en Données</h2>
                <p class="text-xl text-blue-200">
                    Quelques chiffres clés pour comprendre la richesse de notre pays
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Art -->
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-sm text-center card-hover animate-fadeIn delay-100">
                    <div class="text-5xl font-bold text-yellow-300 mb-3 counter" data-target="500">0</div>
                    <h3 class="text-xl font-semibold mb-2">Œuvres d'Art Classées</h3>
                    <p class="text-blue-200">Textiles, sculptures et artisanats traditionnels</p>
                    <div class="mt-4 text-yellow-300 text-3xl">
                    </div>
                </div>

                <!-- Festivals -->
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-sm text-center card-hover animate-fadeIn delay-200">
                    <div class="text-5xl font-bold text-yellow-300 mb-3 counter" data-target="200">0</div>
                    <h3 class="text-xl font-semibold mb-2">Festivals Annuels</h3>
                    <p class="text-blue-200">Célébrations culturelles et religieuses</p>
                    <div class="mt-4 text-yellow-300 text-3xl">
                    </div>
                </div>

                <!-- Cuisine -->
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-sm text-center card-hover animate-fadeIn delay-300">
                    <div class="text-5xl font-bold text-yellow-300 mb-3 counter" data-target="30">0</div>
                    <h3 class="text-xl font-semibold mb-2">Plats Traditionnels</h3>
                    <p class="text-blue-200">Saveurs uniques à découvrir</p>
                    <div class="mt-4 text-yellow-300 text-3xl">
                    </div>
                </div>

                <!-- Langues -->
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-sm text-center card-hover animate-fadeIn delay-400">
                    <div class="text-5xl font-bold text-yellow-300 mb-3 counter" data-target="15">0</div>
                        <h3 class="text-xl font-semibold mb-2">Langues Parlées</h3>
                            <p class="text-blue-200">Diversité linguistique exceptionnelle</p>
                        <div class="mt-4 text-yellow-300 text-3xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section CTA -->
    <section id="contact" class="py-24 bg-yellow-50">
        <div class="container mx-auto px-6 max-w-4xl text-center animate-fadeIn">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Prêt à Explorer le Bénin ?</h2>
            <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                Contactez-nous pour planifier votre voyage inoubliable à travers notre riche patrimoine culturel et naturel.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{route('contact')}}" class="px-8 py-4 bg-black-600 hover:bg-black-700 border-2 border-black-600 text-black hover:bg-black-600 hover:text-black font-medium rounded-full transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i> Nous Appeler
                </a>
                <a href="{{route('contact')}}" class="px-8 py-4 bg-black-600 hover:bg-black-700 border-2 border-black-600 text-black hover:bg-black-600 hover:text-black font-medium rounded-full transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i> Envoyer un Email
                </a>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Animation des compteurs
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = Math.ceil(target / speed);
                
                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(animateCounters, 10);
                } else {
                    counter.innerText = target + "+";
                }
            });
        }
        
        // Détection de l'intersection pour déclencher les animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        document.querySelectorAll('.counter').forEach(counter => {
            observer.observe(counter);
        });
        
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.animate-fadeIn');
            
            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            elements.forEach(el => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                fadeInObserver.observe(el);
            });
        });
    </script>

<x-footer/>

</body>
</html>