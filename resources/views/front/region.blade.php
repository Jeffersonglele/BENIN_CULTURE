<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terre Béninoise</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-CxrrfATK.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/swiper.css')}}">
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Space Grotesk', 'sans-serif'],
                },
                extend: {}
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/africa-map.svg') }}');
            background-size: cover;
            background-position: center;
            color: #fff;    
        }
        
        #mapContainer {
           height: 600px; /* ou min-height: 100vh; */
           position: relative;
        }

        /* Style pour l'icône de punaise */
        .pin-icon {
            pointer-events: none;
            z-index: 100;
        }
        
        .pin-icon svg {
            filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.3));
            width: 30px;
            height: 30px;
        }

        #mapContainer svg path {
            fill: #f1f1f1;
            stroke: #c8c8c8;
            stroke-width: 1.5;
            cursor: pointer;
            transition: .3s ease;
        }

        #mapContainer svg path:hover {
            fill: #E2E9C0;
        }

        #mapContainer svg path.active {
            fill: #FFC800 !important;
            stroke: #a88500;
            filter: drop-shadow(0 6px 10px rgba(255, 199, 0, .6));
        }

        .depart-selected {
            fill: #FFCC00 !important;
            filter: drop-shadow(0px 8px 16px #d4a300);
        }

        .map-marker {
            position: absolute;
            width: 32px;
            height: 32px;
            transform: translate(-50%, -100%);
        }
        .typed-text {
            color: #000000; /* Noir */
            font-size: 1.5rem; /* Taille de police plus grande */
            font-weight: 600; /* Texte en gras */
            min-height: 2rem; /* Hauteur minimale pour éviter les sauts de ligne */
            display: inline-block; /* Pour que le curseur s'affiche correctement */
        }

        @media (max-width: 1200px) {

            .benin-map {
                width: 50%;
                height: auto;
                max-width: 520px;
                /*margin: 0 auto;
                border-radius: 10px;
                padding: 8px;
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.35);*/
                overflow: hidden;
                position: relative;
            }

            .map-pin {
                position: absolute;
                width: 24px;
                height: 24px;
                transform: translate(-50%, -100%);
                pointer-events: none;
                opacity: 0;
                transition: opacity .25s, transform .25s;
            }

            .map-pin.visible {
                opacity: 1;
                transform: translate(-50%, -100%) scale(1);
            }

            .map-pin svg {
                width: 10%;
                height: 10%;
            }

            .details-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .info-panel {
                max-width: 95%;
                padding: 15px;
            }

            .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .info-panel {
                min-height: 450px;
            }
        }
    </style>
</head>

<body>
    <x-navbar />
    <header class="relative h-96 md:h-screen max-h-[800px] overflow-hidden">
        <!-- Image de fond -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/region-bg.jpg') }}"
                alt="Régions du Bénin"
                class="w-full h-full object-cover object-center">
            <!-- Overlay avec dégradé pour le texte -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
        </div>

        <!-- Contenu du header -->
        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
            <div class="text-center w-full">
                <span class="block text-[#ffcd00] text-xs md:text-sm font-bold tracking-[0.2em] uppercase mb-4">
                    Bienvenue au Bénin
                </span>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight"
                    style="color:#E2E9C0;">
                    Diversité <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E2E9C0] to-[#ffd700]">Touristique</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto leading-relaxed mb-8">
                    Découvrez la richesse d'une terre ancestrale. Chaque région raconte une histoire unique et témoigne de l'identité vibrante des différentes communautés.
                </p>

                <div class="w-24 h-1 bg-[#E2E9C0] mx-auto rounded-full opacity-80"></div>
            </div>
        </div>
    </header>

    <div class="w-full max-w-4xl mx-auto px-6 py-10 mt-20 mb-16 animate-fadeLeft relative">
        <!-- SVG décoratif -->
        <div class="absolute -left-4 top-0 h-full hidden md:block">
            <svg width="30" height="300" viewBox="0 0 40 300" class="hidden md:block">
                <defs>
                    <style>
                        .motif {
                            stroke: #5b3a1a;
                            stroke-width: 2.5;
                            fill: none;
                        }
                    </style>
                </defs>
                <g class="motif">
                    <path d="M20 10 L35 35 L5 35 Z" />
                    <path d="M5 60 L35 80 L5 100 L35 120 L5 140" />
                    <circle cx="20" cy="170" r="12" />
                    <path d="M5 200 L35 220 L5 240 L35 260 L5 280" />
                    <path d="M20 290 L35 265 L5 265 Z" />
                </g>
            </svg>
        </div>
        <h2 class="text-3xl md:text-5xl text-black font-bold mb-4">
            Découvrez le Bénin
        </h2>

        <div class="text-gray-800 text-xl md:text-2xl leading-relaxed min-h-24">
            <p class="text-gray-800 text-xl md:text-2xl leading-relaxed">
                Une destination mémorable au cœur de l’Afrique de l’Ouest.  
                Un pays vibrant où l’histoire millénaire, les cultures vivantes, les traditions profondes,
                les langues locales, la spiritualité et les merveilles naturelles se rencontrent pour offrir
                une expérience authentique et inoubliable.
            </p>
        </div>

        <div class="h-12 md:h-16">
            <span class="typed-text" data-typed-items='["Culture riche et authentique", "Histoire millénaire", "Traditions vivantes", "Paysages époustouflants", "Accueil chaleureux"]'></span>
        </div>
    </div>


    <br>
    <br>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Contenu principal (Swiper) -->
            <div class="w-full lg:w-2/3">
                <div class="bg-gold-400 px-6 py-1 text-center text-black md:hidden">
                    <div class="border-b border-black py-4"> Sélectionnez une région à découvrir
                        : </div>
                    <div class="swiper relative swiper-initialized swiper-horizontal">
                        <div class="swiper-wrapper"
                            style="cursor: grab; transition-duration: 600ms;">
                            <div class="swiper-slide !w-fit py-4 text-xl swiper-slide-next"
                                data-swiper-slide-index="5">Plateau</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="6">Zou</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="7">Couffo</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="8">Ouémé</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="9">Atlantique</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="10">Mono</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="11">Littoral</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="0">Alibori</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="1">Atacora</div>
                            <div class="swiper-slide !w-fit py-4 text-xl"
                                data-swiper-slide-index="2">Borgou</div>
                            <div class="swiper-slide !w-fit py-4 text-xl swiper-slide-prev"
                                data-swiper-slide-index="3">Donga</div>
                            <div class="swiper-slide !w-fit py-4 text-xl font-bold underline underline-offset-4"
                                data-swiper-slide-index="4">Collines</div><!--[--><!--]-->
                        </div>
                    </div>
                </div>
                <div class="md:mt-[10%]">
                    <div
                        class="swiper relative h-full bg-neutral-950 text-white md:!overflow-visible swiper-fade swiper-initialized swiper-horizontal swiper-watch-progress">
                        <!-- Boutons de navigation -->
                        <div class="swiper-button-prev !text-white hover:!text-gray-300"></div>
                        <div class="swiper-button-next !text-white hover:!text-gray-300"></div>
                        
                        <div class="swiper-wrapper"
                            style="transition-duration: 0ms; transition-delay: 0ms;"><!--[-->
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="0">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Alibori</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Situé au nord, l’Alibori abrite le parc national
                                                du « W », célèbre pour sa faune&nbsp;et ses
                                                paysages <span
                                                    style="font-weight: 400;">grandioses</span>.
                                                Ses marchés animés, dont Malanville, dévoilent
                                                l’artisanat local <span
                                                    style="font-weight: 400;"> et les produits
                                                    régionaux</span>.</p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Kandi</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    26 242 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    6</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/pendjari-2_201171578 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/pendjari-2_201171578 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/pendjari-2_201171578 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/pendjari-2_201171578 1400w">
                                                        <!--]--><img width="2560" height="1707"
                                                            alt="parc national du W"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/pendjari-2_201171578"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/pendjari-2_201171578 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/pendjari-2_201171578 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/pendjari-2_201171578 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/pendjari-2_201171578 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Le Parc National du
                                                    W</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 1; transform: translate3d(-747px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="1">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Atacora</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Région montagnarde qui séduit par ses paysages
                                                verdoyants, ses impressionnantes chutes d’eau,
                                                et ses traditionnelles tata somba, offrant une
                                                immersion authentique dans la culture locale.
                                            </p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Natitingou </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    20 499 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    9</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/photo-atacora 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/photo-atacora 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/photo-atacora 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/photo-atacora 1400w">
                                                        <!--]--><img width="5472" height="3648"
                                                            alt="atakora"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-atacora"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/photo-atacora 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/photo-atacora 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/photo-atacora 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-atacora 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Parc National de la
                                                    Pendjari </span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 1; transform: translate3d(-1494px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="2">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Borgou</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Au nord-est, le Borgou <span
                                                    style="font-weight: 400;">séduit par ses
                                                    vastes </span>paysages <span
                                                    style="font-weight: 400;">pittoresques.
                                                </span>Parakou, son centre économique, <span
                                                    style="font-weight: 400;">est un point de
                                                    départ idéal </span>pour explorer <span
                                                    style="font-weight: 400;">les richesses
                                                    culturelles et historiques
                                                    locales.&nbsp;&nbsp;</span></p><br>
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Parakou</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    25 856 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    8</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_266,c_fill/nikki_2017516dc 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_466,c_fill/nikki_2017516dc 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_532,c_fill/nikki_2017516dc 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_932,c_fill/nikki_2017516dc 1400w">
                                                        <!--]--><img width="2047" height="1363"
                                                            alt="cité royale de Nikki"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_932,c_fill/nikki_2017516dc"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_266,c_fill/nikki_2017516dc 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_466,c_fill/nikki_2017516dc 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_532,c_fill/nikki_2017516dc 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_932,c_fill/nikki_2017516dc 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La Fête de la Gaani à
                                                    Nikki</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto swiper-slide-prev"
                                style="width: 747px; opacity: 1; transform: translate3d(-2241px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="3">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Donga</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p><span style="font-weight: 400;">Au nord-ouest, la
                                                    Donga séduit par ses paysages naturels. La
                                                    région est réputée pour le charme de ses
                                                    villages pittoresques, où les traditions
                                                    ancestrales se mêlent à une beauté
                                                    authentique.</span></p><br>
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Djougou</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    11 126 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    4</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_423,c_fill/djougou_20213b7cc 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_740,c_fill/djougou_20213b7cc 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_846,c_fill/djougou_20213b7cc 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_1480,c_fill/djougou_20213b7cc 1400w">
                                                        <!--]--><img width="417" height="441"
                                                            alt="Djougou"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_1480,c_fill/djougou_20213b7cc"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_423,c_fill/djougou_20213b7cc 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_740,c_fill/djougou_20213b7cc 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_846,c_fill/djougou_20213b7cc 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_1480,c_fill/djougou_20213b7cc 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La ville de
                                                    Djougou</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto swiper-slide-visible swiper-slide-fully-visible swiper-slide-active"
                                style="width: 747px; opacity: 1; transform: translate3d(-2988px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="4">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Collines</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Région centrale, les Collines enchantent par
                                                <span style="font-weight: 400;">ses charmants
                                                    villages. La beauté naturelle et l’accueil
                                                    chaleureux des habitants </span>offrent une
                                                immersion <span
                                                    style="font-weight: 400;">mémorable
                                                </span>dans la culture béninoise.
                                            </p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Dassa-Zoumé</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    13 931 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    6</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2] md:shadow-xl"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/photo-collines 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/photo-collines 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/photo-collines 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/photo-collines 1400w">
                                                        <!--]--><img width="2500" height="1668"
                                                            alt="collines"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-collines"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/photo-collines 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/photo-collines 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/photo-collines 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-collines 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La ville de
                                                    Dassa-Zoumé</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto swiper-slide-next"
                                style="width: 747px; opacity: 0; transform: translate3d(-3735px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="5">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Plateau</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p><span style="font-weight: 400;">Le Plateau, au
                                                    sud, se distingue par ses collines
                                                    pittoresques. La ville de Ketou, berceau du
                                                    masque Guèlèdè inscrit à l’UNESCO, reflet
                                                    des traditions ancestrales et la richesse
                                                    culturelle béninoise.</span></p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Pobè</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    3 264 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    5</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_312,c_fill/guelede_2029fc767 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_546,c_fill/guelede_2029fc767 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_624,c_fill/guelede_2029fc767 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_1092,c_fill/guelede_2029fc767 1400w">
                                                        <!--]--><img width="2560" height="1996"
                                                            alt="Kétou"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_1092,c_fill/guelede_2029fc767"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_312,c_fill/guelede_2029fc767 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_546,c_fill/guelede_2029fc767 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_624,c_fill/guelede_2029fc767 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_1092,c_fill/guelede_2029fc767 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Ketou : le masque
                                                    Guèlèdè</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-4482px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="6">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Zou</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Au sud, le Zou est marqué par Abomey, ancienne
                                                capitale royale du puissant royaume du Dahomey,
                                                célèbre pour ses palais classés à l’UNESCO. Il
                                                est témoin d’un riche héritage culturel <span
                                                    style="font-weight: 400;">exceptionnel</span>.
                                            </p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Abomey</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    5 243 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    9</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_600,c_fill/abomey_2031493b4 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_1050,c_fill/abomey_2031493b4 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_1200,c_fill/abomey_2031493b4 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_2100,c_fill/abomey_2031493b4 1400w">
                                                        <!--]--><img width="1667" height="2500"
                                                            alt="cité royale d’Abomey"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_2100,c_fill/abomey_2031493b4"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_600,c_fill/abomey_2031493b4 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_1050,c_fill/abomey_2031493b4 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_1200,c_fill/abomey_2031493b4 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_2100,c_fill/abomey_2031493b4 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La statue du Roi
                                                    Béhanzin</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-5229px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="7">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Couffo</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Entre terre et lagune, le Couffo est un havre de
                                                paix, calme et authentique, pour les amateurs de
                                                nature. Des rizières aux lagunes tranquilles,
                                                plongez dans des traditions toujours vivantes.
                                            </p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Aplahoué </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    2 404 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    6</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="{{asset('images/coton.jpg')}}">
                                                        <!--]--><img width="2560" height="1810"
                                                            alt="Coton"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="{{asset('images/coton.jpg')}}"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="{{asset('images/coton.jpg')}}"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Les champs de
                                                    coton</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-5976px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="8">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Ouémé</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Au sud-est, l’Ouémé se distingue par<span
                                                    style="font-weight: 400;"> sa ville
                                                    historique de Porto-Novo</span>, riche en
                                                patrimoine culturel. <span
                                                    style="font-weight: 400;">Porto-Novo,
                                                </span><span style="font-weight: 400;">capitale
                                                    du pays, enchante par ses monuments
                                                    historiques et ses musées fascinants.</span>
                                            </p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Porto-Novo</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    1 281 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    9</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/porto-novo 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/porto-novo 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/porto-novo 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/porto-novo 1400w">
                                                        <!--]--><img width="2500" height="1667"
                                                            alt="porto novo"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/porto-novo"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/porto-novo 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/porto-novo 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/porto-novo 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/porto-novo 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La Grande Mosquée de
                                                    Porto-Novo</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-6723px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="9">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Atlantique</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Célèbre pour ses plages&nbsp;et son ananas
                                                renommé, l’Atlantique allie modernité et charme
                                                côtier, une destination parfaite pour <span
                                                    style="font-weight: 400;">les amateurs de
                                                    détente et de découvertes, situé le long de
                                                    la côte sud.</span></p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Allada</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    3 233 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    8</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/porte-du-non-retour 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/porte-du-non-retour 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/porte-du-non-retour 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/porte-du-non-retour 1400w">
                                                        <!--]--><img width="2000" height="1333"
                                                            alt="Ouidah"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/porte-du-non-retour"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/porte-du-non-retour 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/porte-du-non-retour 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/porte-du-non-retour 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/porte-du-non-retour 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">La Porte du
                                                    Non-Retour</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-7470px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="10">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Mono</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Au sud, le Mono offre des plages paradisiaques à
                                                Grand-Popo, <span style="font-weight: 400;">un
                                                    véritable paradis côtier avec son sable doré
                                                    et ses eaux cristallines, </span>un havre de
                                                paix pour la détente et les activités
                                                balnéaires.</p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Lokossa</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    1 605 km² </div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    6</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/photo-mono 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/photo-mono 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/photo-mono 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/photo-mono 1400w">
                                                        <!--]--><img width="2500" height="1668"
                                                            alt="mono"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-mono"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/photo-mono 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/photo-mono 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/photo-mono 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-mono 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Les plages de Grand-Popo
                                                </span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide bg-neutral-950 max-md:!h-auto"
                                style="width: 747px; opacity: 0; transform: translate3d(-8217px, 0px, 0px); transition-duration: 0ms;"
                                data-swiper-slide-index="11">
                                <div class="flex h-full flex-col md:grid md:grid-cols-5">
                                    <div
                                        class="p-6 max-md:flex max-md:flex-grow max-md:flex-col md:col-span-4 md:px-14 md:py-10 lg:col-span-3 bg-[#E2E9C0]/70 backdrop-blur-sm">
                                        <h3 class="mb-4 text-2xl font-bold">Littoral</h3>
                                        <div class="mb-10 text-lg max-md:mb-auto">
                                            <p>Situé au centre du Bénin, le Littoral allie
                                                dynamisme urbain et richesse culturelle.
                                                Découvrez Cotonou avec ses boulevards animés,
                                                marchés artisanaux et monuments historiques. Ses
                                                plages et événements culturels en font un lieu
                                                vibrant.</p>
                                        </div>
                                        <div class="grid gap-2"
                                            style="grid-template-columns:repeat(3, minmax(0, 1fr));">
                                            <!--[-->
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:home text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Chef-lieu</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    Cotonou</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:enlarge text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Superficie</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    79 km²</div>
                                            </div>
                                            <div class="flex flex-col items-center gap-1"><span
                                                    class="iconify i-benin:municipalities text-2xl text-white lg:text-3xl"
                                                    aria-hidden="true" style=""></span>
                                                <div
                                                    class="text-balance text-center text-xs font-bold text-white/70">
                                                    Communes</div>
                                                <div
                                                    class="text-balance text-center text-white/70 md:max-lg:text-sm">
                                                    1</div>
                                            </div><!--]-->
                                        </div>
                                    </div>
                                    <div class="md:col-span-1 lg:col-span-2">
                                        <div class="swiper origin-center-left md:scale-[2] lg:origin-bottom-left lg:scale-[1.2]"
                                            data-v-d0e669e8="">
                                            <div class="swiper-wrapper" data-v-d0e669e8=""
                                                style="transform: translate3d(0px, 0px, 0px);">
                                                <!--[-->
                                                <div class="swiper-slide relative swiper-slide-active"
                                                    data-v-d0e669e8="" style="width: 299px;">
                                                    <picture
                                                        class="block overflow-clip bg-neutral-950"
                                                        data-v-d0e669e8="" style=""><!--[-->
                                                        <source type="image/webp"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_400,h_267,c_fill/photo-littoral 400w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_700,h_467,c_fill/photo-littoral 700w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_800,h_534,c_fill/photo-littoral 800w, https://res.cloudinary.com/benin/image/upload/f_webp,q_80,w_1400,h_934,c_fill/photo-littoral 1400w">
                                                        <!--]--><img width="2500" height="1667"
                                                            alt="littoral"
                                                            onerror="this.setAttribute('data-error', 1)"
                                                            class="aspect-[4/3] md:aspect-[.8] w-full h-full object-cover object-center mx-auto transition"
                                                            data-nuxt-pic=""
                                                            src="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-littoral"
                                                            sizes="(max-width: 768px) 400px, 700px"
                                                            srcset="https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_400,h_267,c_fill/photo-littoral 400w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_700,h_467,c_fill/photo-littoral 700w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_800,h_534,c_fill/photo-littoral 800w, https://res.cloudinary.com/benin/image/upload/f_jpg,q_80,w_1400,h_934,c_fill/photo-littoral 1400w"
                                                            style="opacity: 1; transform: none;">
                                                    </picture>
                                                    <div class="absolute inset-0 z-[1] flex items-end bg-gradient-to-t from-black/40 via-black/20 to-black/0"
                                                        data-v-d0e669e8=""></div>
                                                </div><!--]-->
                                            </div>
                                            <div class="absolute bottom-14 left-0 z-[1] flex w-full items-center justify-center gap-2 text-center md:hidden"
                                                data-v-d0e669e8=""><span class="text-lg"
                                                    data-v-d0e669e8="">Le Monument de
                                                    l’Amazone</span><span
                                                    class="iconify i-heroicons:map-pin-solid text-3xl"
                                                    aria-hidden="true" style=""
                                                    data-v-d0e669e8=""></span></div>
                                            <div class="swiper-pagination absolute !bottom-6 w-32 md:hidden swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock"
                                                data-v-d0e669e8=""><span
                                                    class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--]-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte à droite -->
            <div class="w-full lg:w-1/3 sticky top-4 h-fit">
                <div id="mapContainer" class="w-full h-96 lg:h-full overflow-hidden">
                    <svg width="100%" height="100%" viewBox="0 0 329 647" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
                        xmlns:serif="http://www.serif.com/"
                        style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;"><!--[-->
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="231.76500701904297 103.49950313568115"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-0"
                                d="M301.855,80.529L299.505,82.781L292.201,94.739L290.879,99.462L290.234,100.981L288.129,106.454L288.082,108.904L289.718,111.693L307.5,137.927L309.914,140.271L310.682,140.286L311.604,140.304L312.373,140.319L313.28,141.103L312.126,145.063L312.082,147.36L312.501,149.512L313.233,151.365L314.273,153.223L316.245,162.452L316.186,165.515L313.773,170.982L313.737,172.819L314.174,174.053L314.925,174.987L315.832,175.77L316.582,176.704L317.022,177.785L317.879,181.172L318.777,182.414L320.151,182.901L321.528,183.234L322.742,184.024L323.626,186.032L324.027,189.103L323.979,191.553L285.171,195.085L260.486,199.659L235.707,201.167L220.861,197.814L215.329,197.706L198.845,199.529L182.733,197.99L177.491,198.806L172.26,199.011L166.858,200.131L161.941,200.035L163.028,199.444L163.209,166.514L163.242,164.83L163.88,163.617L164.992,161.801L167.034,159.543L173.28,154.61L169.962,151.328L168.747,150.539L168.44,150.533L167.518,150.515L167.066,150.046L166.153,149.569L164.929,149.239L164.007,149.221L159.077,141.926L139.952,105.71L139.503,105.088L153.141,91.568L160.79,85.59L166.382,82.636L167.792,81.285L168.117,80.372L168.174,77.463L169.306,74.575L173.388,70.212L174.825,67.483L178.71,57.449L178.731,56.377L177.384,54.513L177.404,53.441L177.892,52.072L179.736,52.108L180.664,51.82L181.294,51.066L182.092,49.55L182.875,48.799L183.951,48.82L185.021,49.147L185.789,49.162L185.828,47.172L185.852,45.947L184.939,45.47L184.023,45.145L182.956,44.665L181.898,43.725L181.148,42.792L180.554,41.708L177.364,31.842L176.402,26.003L176.447,23.706L177.251,21.884L179.731,20.86L181.114,20.887L183.419,20.932L184.802,20.959L185.118,20.505L185.91,19.296L186.38,18.845L187.149,18.86L187.748,19.638L188.209,19.647L188.842,18.74L189.327,17.524L190.101,17.233L191.023,17.251L192.249,17.428L192.551,17.74L192.539,18.353L192.991,18.821L193.759,18.836L194.383,18.388L195.323,17.488L195.79,17.191L199.496,16.344L199.957,16.353L200.867,16.983L201.328,16.992L201.948,16.698L203.196,15.803L203.964,15.818L207.483,16.653L208.417,16.058L209.845,13.788L210.167,13.029L210.182,12.263L210.658,11.507L211.285,10.906L212.369,10.468L213.43,11.254L214.512,10.969L215.449,10.221L217.178,8.264L218.269,7.519L219.191,7.537L221.188,7.576L222.264,7.597L224.729,7.339L225.988,5.832L230.818,10.368L232.949,11.482L234.004,12.574L234.748,13.814L235.318,16.123L236.068,17.057L237.132,17.69L238.353,18.174L241.727,18.546L242.643,18.87L242.939,19.488L243.976,21.5L248.005,27.706L265.21,44.124L265.505,44.743L266.867,45.842L267.163,46.46L267.425,48.763L267.841,51.069L268.574,52.921L270.801,56.947L272.151,58.658L273.059,59.442L274.27,60.385L275.647,60.718L277.042,60.132L278.443,59.24L279.666,59.571L280.73,60.204L281.8,60.531L286.353,63.531L290.014,64.981L291.075,65.767L291.828,66.548L295.113,71.513L295.716,72.138L296.325,72.456L296.777,72.924L297.069,73.696L297.497,75.389L297.79,76.161L297.772,77.079L298.372,77.857L299.285,78.334L300.174,80.037L300.93,80.664L301.855,80.529Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Alibori">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="227.27599334716797 286.7540054321289"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-1"
                                d="M324.287,191.559L324.224,194.775L323.402,197.516L320.689,202.671L319.713,205.409L319.608,210.768L318.801,212.744L317.226,214.704L315.683,214.981L309.141,211.483L306.996,211.135L304.986,211.709L302.949,213.66L302.317,214.567L301.998,215.173L301.959,217.164L301.474,218.38L298.784,222.31L296.54,227.015L296.501,229.005L297.993,231.332L304.768,238.663L305.666,239.906L305.94,241.597L305.597,243.428L305.585,244.04L304.465,246.316L303.218,247.211L301.666,247.947L300.1,249.448L299.452,251.12L298.664,259.989L297.55,261.959L294.091,265.874L291.23,270.719L289.353,272.368L283.218,271.635L279.202,272.629L271.766,275.548L270.052,276.74L269.091,278.712L268.739,281.003L269.008,283L270.174,286.239L270.88,289.47L270.058,292.211L266.641,293.982L264.797,293.946L262.809,293.448L261.109,293.874L260.29,296.462L260.275,297.228L260.863,298.618L260.854,299.077L254.396,307.07L253.615,307.667L251.913,308.247L251.133,308.844L249.072,312.021L248.555,314.921L249.112,317.842L250.279,321.082L250.554,322.772L250.422,329.509L249.766,331.641L247.537,335.58L243.95,346.079L242.351,349.265L239.859,350.901L232.908,352.604L231.679,352.58L230.612,352.099L229.702,351.469L228.636,350.988L227.56,350.967L224.487,350.908L223.411,350.887L222.317,351.784L221.377,352.685L220.44,353.433L219.057,353.406L211.229,352.794L211.483,355.556L211.355,362.14L210.532,364.881L210.213,365.487L209.105,367.151L208.797,367.145L208.93,368.219L209.391,368.228L209.843,368.697L210.289,369.471L210.259,371.003L208.82,373.885L208.482,375.41L208.465,376.329L209.049,377.872L209.031,378.791L208.405,379.391L206.7,380.124L206.07,380.877L206.049,381.949L152.124,380.285L153.117,376.628L152.515,376.004L152.207,375.998L151.602,375.526L141.516,372.419L139.537,371.462L138.627,370.831L137.87,370.204L137.117,369.423L136.517,368.646L136.225,367.874L135.935,366.949L135.516,364.797L135.549,363.112L135.647,358.06L135.671,356.835L135.825,356.838L136.355,353.325L137.017,350.887L137.981,348.761L137.993,348.149L138.158,347.539L138.173,346.774L137.574,345.996L137.275,345.531L136.974,345.219L133.927,343.781L133.168,343.306L132.716,342.838L132.116,342.06L131.516,341.283L131.073,340.355L131.082,339.896L130.509,337.74L130.265,334.519L130.378,328.7L131.062,325.19L132.685,320.78L133.622,320.032L134.399,319.588L134.86,319.597L136.559,319.171L139.018,319.219L142.86,319.294L143.474,319.305L144.875,318.414L145.502,317.813L145.975,317.21L146.309,315.838L150.821,289.426L150.851,287.895L149.965,286.04L148.304,284.476L146.198,282.137L144.856,279.966L144.865,279.507L142.824,273.8L142.851,272.422L142.887,270.584L143.917,265.09L144.742,262.196L144.781,260.205L143.957,255.134L144.909,253.621L144.921,253.009L145.083,252.552L144.203,250.391L143.781,248.391L143.79,247.932L143.802,247.319L144.124,246.56L144.91,245.656L145.537,245.055L146.158,244.761L147.089,244.32L148.17,244.035L153.702,244.142L155.405,243.563L159.427,242.263L160.358,241.821L161.138,241.224L161.921,240.473L162.238,240.02L162.262,238.795L162.611,236.657L161.986,229.293L160.695,224.519L160.421,222.829L158.962,218.818L158.516,218.043L157.916,217.266L155.351,214.765L154.752,213.987L154.459,213.216L154.465,212.909L154.32,212.447L154.35,210.916L154.534,209.388L155.181,207.715L156.455,205.443L159.133,202.125L159.441,202.131L159.757,201.678L161.932,200.495L166.85,200.591L172.252,199.47L177.483,199.266L182.725,198.449L198.836,199.989L215.323,198.013L220.856,198.121L235.699,201.627L260.478,200.118L285.163,195.545L323.971,192.013L324.287,191.559Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Borgou">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="191.93500518798828 554.9055023193359"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-2"
                                d="M203.981,495.872L203.608,499.234L204.145,503.227L206.068,507.094L209.07,510.829L211.3,514.702L210.909,518.983L210.584,519.896L210.572,520.508L210.108,520.653L207.966,520.151L206.89,520.13L206.113,520.575L205.785,521.641L207.443,546.947L207.416,548.325L206.938,549.235L206.148,550.292L205.188,552.264L204.715,552.868L204.7,553.633L204.98,555.017L205.881,556.107L208.452,558.302L209.049,559.232L208.567,560.295L207.479,560.887L206.087,561.319L204.846,561.907L202.162,565.531L202.397,569.212L203.703,573.22L204.08,577.517L202.921,581.783L202.572,583.92L202.994,585.92L203.741,587.007L204.652,587.637L205.721,587.964L206.951,587.988L207.553,588.613L207.532,589.685L208.055,594.443L207.416,595.656L206.172,596.398L204.295,598.046L203.024,600.166L202.982,602.31L203.667,606.612L203.625,608.755L201.366,614.226L197.502,607.411L195.998,605.696L191.161,601.466L189.226,598.212L187.308,586.227L182.621,574.341L181.8,569.117L181.902,563.911L184.053,563.953L184.821,563.968L185.436,563.98L185.897,563.989L186.213,563.535L186.216,563.382L185.845,558.78L183.764,547.251L183.797,545.567L183.808,544.954L183.206,544.33L178.508,540.868L177.037,537.47L175.619,531.315L175.336,530.084L175.366,528.553L174.923,527.625L174.323,526.848L174.034,525.923L174.123,521.33L173.547,519.327L172.83,516.709L172.57,514.253L173.844,511.98L177.161,507.45L178.249,506.858L179.794,506.429L180.122,505.363L179.405,502.745L179.769,499.842L181.389,495.585L182.772,495.612L203.825,496.022L203.981,495.872Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Plateau">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="185.19100189208984 596.5920104980469"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-3"
                                d="M200.999,617.282L200.141,621.86L200.019,628.138L177.541,629.844L177.574,628.16L176.812,627.839L176.351,627.83L175.598,627.049L175.947,624.911L177.715,620.963L178.223,618.522L177.852,613.92L176.641,612.977L176.186,612.662L175.577,612.344L174.962,612.332L173.928,610.167L173.342,600.812L173.402,597.75L173.156,586.716L172.965,580.739L171.97,576.584L168.546,570.849L168.588,568.706L169.856,566.739L171.591,564.475L173.299,563.589L176.225,563.34L182.525,563.463L182.27,568.666L183.091,573.89L187.778,585.776L189.697,597.761L191.631,601.016L196.468,605.246L197.972,606.96L201.836,613.775L201.508,614.841L201.159,616.978L200.999,617.282Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Ouémé">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="91.6395034790039 178.45450592041016"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-4"
                                d="M79.317,101.311L80.404,100.719L81.049,99.2L82.721,100.152L84.71,100.65L94.376,101.604L94.364,102.217L93.873,103.739L93.862,104.351L95.398,104.381L97.472,108.404L99.482,107.831L101.19,106.945L105.974,105.966L107.99,105.086L109.536,104.657L113.986,105.05L115.984,105.089L120.012,103.483L122.018,103.062L123.85,103.711L124.784,103.116L126.014,103.14L128.599,104.569L132.869,106.337L136.551,106.716L139.344,105.391L139.814,104.941L140.263,105.562L159.387,141.779L164.318,149.074L165.24,149.092L166.464,149.422L167.377,149.899L167.832,150.215L168.293,150.224L168.748,150.539L169.055,150.545L170.266,151.488L173.584,154.769L167.339,159.702L165.297,161.96L164.185,163.776L163.854,164.995L163.821,166.679L163.487,199.606L162.399,200.197L160.224,201.38L159.91,201.68L159.603,201.674L156.922,205.145L155.648,207.418L155,209.09L154.971,210.622L154.787,212.15L154.778,212.609L154.926,212.918L155.218,213.69L155.818,214.467L158.383,216.968L158.982,217.746L159.428,218.52L160.887,222.531L161.162,224.222L162.452,228.995L163.077,236.36L163.036,238.504L162.704,239.723L162.388,240.176L161.605,240.927L160.825,241.524L159.894,241.965L155.871,243.266L154.175,243.539L148.643,243.431L147.558,243.869L146.627,244.311L146.007,244.605L145.38,245.205L144.594,246.109L144.272,246.869L144.26,247.481L144.251,247.941L144.673,249.94L115.648,248.455L111.779,249.758L108.203,251.833L104.769,254.523L100.424,256.583L95.329,257.709L88.89,256.818L84.608,255.662L79.703,254.953L75.4,254.87L69.54,255.828L68.302,256.263L68.317,255.497L67.002,251.949L56.386,244.542L41.979,234.458L33.333,228.469L27.571,224.374L18.016,217.754L10.434,212.399L9.695,210.852L9.743,208.402L11.335,197.711L12.985,191.923L13.063,187.942L12.477,178.586L14.082,175.095L19.719,169.843L21.137,168.033L21.466,166.967L21.51,164.67L21.839,163.605L23.435,160.572L23.456,159.5L22.422,157.336L22.136,156.258L22.482,154.273L25.219,147.893L28.26,149.638L29.643,149.665L31.484,149.854L31.957,149.25L32.288,148.031L32.312,146.806L31.709,146.182L30.95,145.708L30.661,144.783L30.684,143.558L30.705,142.486L31.019,142.186L31.967,140.826L32.606,139.613L33.239,138.706L34.161,138.724L36.46,139.075L37.065,139.547L37.517,140.015L38.132,140.027L38.43,140.492L39.024,141.576L39.018,141.882L39.787,141.897L40.874,141.306L41.335,141.315L44.403,141.681L45.472,142.008L45.771,142.473L46.518,143.56L47.272,144.341L47.588,143.887L47.621,142.203L46.569,140.957L45.975,139.873L45.996,138.802L45.866,137.574L45.89,136.349L45.429,136.34L44.516,135.862L44.209,135.856L44.221,135.244L44.245,134.019L44.253,133.56L43.331,133.542L42.711,133.836L42.404,133.83L42.43,132.452L42.897,132.155L46.293,131.455L46.917,131.008L47.721,129.185L48.191,128.735L49.266,128.756L51.246,129.713L52.316,130.041L51.891,128.194L51.498,124.664L49.717,121.412L50.202,120.196L51.298,119.145L52.407,117.482L53.314,118.266L54.059,119.506L54.05,119.965L54.818,119.98L55.439,119.686L55.906,119.388L58.825,119.445L60.507,119.938L63.854,121.688L65.132,119.262L65.146,118.496L65.167,117.425L64.11,116.485L64.124,115.719L64.456,114.5L65.519,115.134L66.722,116.536L67.316,117.62L68.102,116.716L68.876,116.425L69.639,116.746L70.389,117.68L72.263,116.184L72.29,114.806L71.087,113.404L70.508,111.555L71.469,109.582L73.494,108.243L75.82,107.216L77.531,106.177L76.651,104.016L76.669,103.097L77.615,101.89L79.016,100.998L80.254,100.563L79.317,101.311Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Atacora">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="110.0354995727539 329.7300033569336"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-12"
                                d="M74.647,325.01L72.709,321.908L71.253,317.744L70.688,307.317L69.515,304.384L67.807,305.27L66.3,303.709L65.272,301.238L65.007,299.088L65.495,297.719L67.392,294.999L68.034,293.633L68.097,290.417L68.425,289.352L68.449,288.127L67.927,283.368L68.082,275.406L67.995,264.069L68.145,256.413L69.383,255.978L75.246,254.867L79.549,254.951L84.451,255.812L88.733,256.968L95.172,257.859L100.267,256.733L104.612,254.674L108.046,251.983L111.622,249.909L115.491,248.605L144.516,250.09L145.396,252.252L145.387,252.711L145.224,253.168L145.221,253.321L144.27,254.834L145.093,259.905L145.054,261.895L144.229,264.79L143.2,270.284L143.164,272.121L143.137,273.499L145.024,279.204L145.015,279.663L146.51,281.837L148.617,284.175L150.277,285.74L151.163,287.595L151.134,289.126L146.622,315.538L146.287,316.91L145.815,317.513L145.188,318.114L144.254,318.708L143.793,318.699L143.172,318.993L139.331,318.918L136.872,318.871L135.176,319.144L134.715,319.135L133.934,319.732L132.997,320.48L131.374,324.89L130.845,328.403L130.731,334.222L130.976,337.443L131.395,339.596L131.386,340.055L132.136,340.989L132.736,341.766L133.336,342.544L133.788,343.012L134.547,343.486L137.594,344.924L137.895,345.237L138.193,345.702L138.64,346.477L138.625,347.242L138.613,347.855L138.601,348.467L137.637,350.593L136.975,353.031L136.445,356.543L136.267,357.765L136.169,362.818L136.136,364.503L136.555,366.655L136.845,367.58L137.137,368.351L137.737,369.129L138.49,369.91L139.246,370.537L140.157,371.168L142.136,372.125L152.222,375.232L152.83,375.55L153.138,375.556L153.737,376.334L152.744,379.991L151.913,383.191L152.811,384.434L153.552,385.827L155.064,395.047L153.507,403.901L154.228,406.366L154.831,406.99L154.038,408.2L152.634,409.245L151.701,409.84L150.459,410.428L148.76,410.855L146.301,410.807L145.687,410.795L145.072,410.783L142.33,409.504L141.1,409.48L138.645,409.279L138.03,409.267L137.575,408.952L136.364,408.009L135.909,407.694L133.007,406.718L132.094,406.241L131.184,405.61L130.43,404.83L128.932,402.809L128.631,402.497L128.176,402.182L127.715,402.173L127.106,401.855L124.033,401.795L123.418,401.783L122.804,401.771L122.195,401.452L121.285,400.822L118.576,397.859L117.819,397.231L116.909,396.601L115.843,396.121L115.228,396.109L113.999,396.085L112.302,396.358L103.342,398.634L102.266,398.613L101.651,398.601L99.654,398.562L92.278,398.418L92.396,384.482L92.581,374.988L92.491,363.805L92.742,350.943L92.028,348.172L91.307,345.707L89.227,341.99L83.058,335.13L75.081,326.397L74.635,325.622L74.647,325.01Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Donga">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="138.9625015258789 533.9905090332031"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-5"
                                d="M91.866,506.246L92.039,497.365L94.034,497.557L114.649,496.734L119.241,497.742L124.729,500.147L128.505,503.59L132.296,506.268L137.044,507.127L142.423,507.231L148.407,507.808L155.584,510.245L173.707,519.023L174.282,521.026L174.193,525.619L174.482,526.544L175.082,527.322L175.525,528.249L175.495,529.781L175.779,531.011L177.196,537.166L178.667,540.565L183.365,544.026L183.968,544.651L183.956,545.263L183.923,546.947L186.004,558.476L186.375,563.079L186.059,563.532L185.598,563.523L184.977,563.817L184.209,563.802L182.211,563.763L175.911,563.64L172.985,563.89L171.277,564.776L169.542,567.039L168.428,569.009L168.386,571.153L137.499,570.55L136.742,569.923L135.034,570.809L133.949,571.247L133.335,571.235L132.422,570.758L128.938,568.086L128.332,567.614L128.341,567.155L127.609,565.303L126.268,563.132L124.595,562.18L122.95,559.851L120.861,556.593L119.195,555.335L118.586,555.017L117.826,554.543L116.639,552.375L115.804,547.917L114.513,543.143L113.03,540.357L111.816,539.568L111.52,538.949L111.08,537.868L107.183,532.737L105.671,531.483L104.92,530.549L104.474,529.774L104.513,527.784L104.221,527.012L103.624,526.081L103.331,525.31L102.767,522.695L97.61,511.259L96.866,510.019L94.765,507.374L91.55,506.699L91.866,506.246Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Zou">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="110.20149993896484 549.4924926757812"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-6"
                                d="M84.608,571.051L84.454,571.048L83.414,569.19L81.56,561.801L89.243,561.951L91.096,561.528L91.389,546.522L91.678,531.67L91.977,516.358L92.174,506.252L95.389,506.928L97.49,509.573L98.234,510.812L103.391,522.248L103.955,524.863L104.248,525.635L104.844,526.565L104.83,527.331L105.098,529.327L105.544,530.102L106.295,531.036L107.807,532.291L111.704,537.421L112.144,538.502L112.44,539.121L113.654,539.91L115.137,542.696L116.427,547.47L117.263,551.928L118.45,554.096L119.21,554.57L119.818,554.888L121.485,556.146L123.574,559.404L125.219,561.733L126.892,562.685L128.233,564.856L128.658,566.702L128.649,567.161L129.408,567.636L132.892,570.308L133.808,570.632L134.423,570.644L135.504,570.359L137.213,569.473L137.969,570.1L138.843,572.568L138.352,574.09L137.714,575.303L135.943,579.405L135.464,580.314L134.678,581.218L133.09,583.791L132.762,584.857L132.744,585.776L132.72,587.001L132.681,588.991L131.398,591.723L125.158,588.538L121.949,587.556L118.568,587.49L113.015,588.454L106.516,590.625L96.79,592.733L94.485,592.688L92.801,592.349L87.32,589.638L86.859,589.629L87.651,588.419L88.142,586.897L87.575,584.435L86.848,582.277L86.423,580.43L86.456,578.746L87.308,574.474L87.335,573.096L86.28,572.003L84.764,570.901L84.608,571.051Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Couffo">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="107.77199935913086 615.00048828125"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-7"
                                d="M88.917,641.749L88.191,639.59L90.363,638.56L103.485,635.753L105.636,635.795L103.788,628.1L101.939,620.405L99.41,616.067L98.5,615.436L96.37,614.322L95.767,613.698L95.785,612.779L95.827,610.636L95.848,609.564L95.097,608.63L93.434,607.219L93.141,606.448L93.165,605.223L92.249,604.898L90.252,604.859L89.492,604.385L88.582,603.755L87.829,602.974L87.229,602.197L86.943,601.119L86.961,600.2L87.286,599.287L87.301,598.522L86.264,596.51L84.902,595.411L84.311,594.174L85.124,591.893L86.7,589.932L87.161,589.941L92.636,592.958L94.326,592.991L96.625,593.342L106.351,591.234L112.85,589.063L118.406,587.946L121.786,588.012L124.993,589.147L131.233,592.332L130.568,594.923L130.532,596.761L130.511,597.832L130.189,598.592L129.406,599.343L128.933,599.946L128.14,601.156L127.815,602.069L127.797,602.988L127.743,605.744L127.937,611.568L127.896,613.712L127.411,614.928L126.766,616.447L124.348,622.22L123.845,624.355L124.09,627.577L125.581,629.903L126.453,632.524L126.724,634.368L126.706,635.286L116.079,636.305L88.912,642.055L88.917,641.749Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Mono">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="150.96149826049805 602.6900024414062"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-8"
                                d="M164.766,630.667L159.379,631.022L151.199,632.7L126.712,634.98L126.73,634.061L126.458,632.218L125.587,629.597L124.095,627.27L123.85,624.049L124.353,621.914L126.772,616.141L127.416,614.621L127.747,613.402L127.789,611.259L127.595,605.434L127.649,602.678L127.667,601.76L127.992,600.847L128.784,599.637L129.257,599.033L130.041,598.283L130.363,597.523L130.384,596.451L130.42,594.614L131.085,592.023L132.522,589.294L132.561,587.303L132.277,586.072L132.295,585.154L132.777,584.091L134.364,581.518L135.151,580.614L135.63,579.704L137.401,575.603L138.039,574.39L138.53,572.868L137.656,570.4L168.389,570.999L171.816,576.58L172.811,580.736L173.002,586.713L173.248,597.747L173.188,600.809L173.775,610.164L174.811,612.176L175.426,612.188L176.035,612.506L176.49,612.821L177.701,613.764L178.073,618.366L177.564,620.807L175.796,624.755L171.02,625.275L168.857,625.845L166.989,627.034L165.736,628.235L164.766,630.667Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Atlantique">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="170.99799346923828 627.8610229492188"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-9"
                                d="M177.387,629.841L164.609,630.817L165.579,628.385L166.832,627.184L168.7,625.995L170.863,625.425L175.639,624.905L175.29,627.043L176.046,627.67L176.507,627.679L176.959,628.148L176.926,629.832L177.387,629.841Z"
                                class="fill-white/0 stroke-gray-400 duration-200 hover:fill-wafer-100 cursor-pointer"
                                data-region="Littoral">
                            </path>
                        </g>
                        <g style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px; transform-box: fill-box;"
                            data-svg-origin="150.13600158691406 449.510498046875"
                            transform="matrix(1,0,0,1,0,0)">
                            <path id="region-10"
                                d="M199.689,471.586L199.68,472.046L200.578,473.289L201.597,476.219L204.002,479.023L204.894,480.572L205.171,482.109L203.981,495.872L182.928,495.461L181.545,495.434L179.925,499.692L179.561,502.595L180.279,505.213L179.95,506.279L178.405,506.708L177.317,507.3L174.001,511.83L172.726,514.103L172.986,516.559L173.704,519.177L155.581,510.399L148.404,507.961L142.42,507.385L137.041,507.28L132.29,506.575L128.499,503.897L124.723,500.453L119.235,498.049L114.643,497.04L94.028,497.864L92.03,497.825L92.069,495.834L92.466,475.469L92.783,459.239L93.409,442.861L93.639,431.071L92.891,422.173L92.448,421.245L91.833,421.233L91.537,420.614L92.046,418.173L92.097,415.57L95.739,410.127L96.082,408.296L95.642,407.215L93.095,403.795L92.658,402.562L92.682,401.337L92.588,398.271L94.432,398.307L99.958,398.721L101.956,398.76L102.573,398.619L103.649,398.64L112.61,396.364L114.306,396.091L115.535,396.115L116.15,396.127L117.217,396.607L118.127,397.237L118.883,397.865L121.592,400.828L122.502,401.458L123.117,401.47L123.726,401.789L124.34,401.801L127.414,401.861L128.028,401.873L128.938,402.503L129.24,402.815L130.738,404.836L131.491,405.616L132.401,406.247L133.314,406.724L136.216,407.7L136.671,408.015L137.882,408.958L138.343,408.967L138.952,409.285L141.411,409.333L142.637,409.51L145.382,410.636L145.997,410.648L146.609,410.813L149.067,410.861L150.77,410.281L152.011,409.693L152.945,409.098L154.349,408.053L155.141,406.843L154.538,406.219L153.818,403.754L155.374,394.9L153.863,385.68L153.121,384.287L152.223,383.044L153.054,379.844L206.979,381.508L208.487,406.658L208.735,409.726L207.898,413.233L207.106,414.443L205.063,416.701L204.425,417.914L204.407,418.833L204.678,420.676L204.66,421.595L203.808,425.867L203.77,427.858L204.029,430.313L204.753,432.625L206.667,436.951L207.393,439.11L207.349,441.407L206.391,443.226L205.282,444.89L204.481,446.559L204.138,448.39L204.019,454.515L202.353,461.069L201.767,467.491L201.442,468.404L200.327,470.373L200.005,471.133L199.996,471.592L199.689,471.586Z"
                                class="fill-gold-500 stroke-gold-500 drop-shadow-xl cursor-pointer"
                                data-region="Collines">
                            </path>
                        </g>
                        <g><!--[--><text x="210" y="110"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Alibori</text><text
                                x="180" y="280"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Borgou</text><text
                                x="190" y="530"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Plateau</text><text
                                x="120" y="460"
                                class="pointer-events-none cursor-pointer duration-200">Collines</text><text
                                x="175" y="590"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Ouémé</text><text
                                x="60" y="210"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Atacora</text><text
                                x="80" y="300"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Donga</text><text
                                x="130" y="545"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Zou</text><text
                                x="65" y="570"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Couffo</text><text
                                x="70" y="620"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Mono</text><text
                                x="150" y="610"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Atlantique</text><text
                                x="155" y="644"
                                class="pointer-events-none fill-gray-400 cursor-pointer duration-200">Littoral</text><!--]-->
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // Données de correspondance entre les IDs des régions et les index des slides
        const regionToSlideMap = {
            'region-0': 0,   // Alibori - Slide 0
            'region-1': 2,   // Borgou - Slide 2
            'region-2': 5,   // Plateau - Slide 5
            'region-3': 8,   // Ouémé - Slide 3
            'region-4': 1,   // Atacora - Slide 1
            'region-5': 6,   //  Zou- Slide 2
            'region-6': 7,   // Couffo - Slide 6
            'region-7': 10,   // Mono - Slide 10
            'region-8': 9,   // Atlatique - Slide 8
            'region-9': 11,   // Littoral - Slide 
            'region-10': 4, // Collines - Slide 4
            'region-12': 3   // Donga - Slide 4
        };
        
        // Variables globales pour les instances Swiper
        let mainSwiper, navSwiper;
        
        // Fonction pour mettre à jour la carte en fonction du slide actif
        function updateMapForSlide(slideIndex) {
            // Pas besoin d'ajuster l'index car on a désactivé le mode loop
            const realIndex = slideIndex;
            const paths = document.querySelectorAll('#mapContainer svg path');
            
            // Réinitialiser tous les chemins
            paths.forEach(p => {
                p.classList.remove('active');
                p.style.fill = ''; // Réinitialiser la couleur de remplissage
            });
            
            // Trouver l'ID de la région correspondant au slide
            let regionId = null;
            for (const [id, index] of Object.entries(regionToSlideMap)) {
                if (index === realIndex) {
                    regionId = id;
                    break;
                }
            }
            
            // Activer le chemin correspondant au slide
            if (regionId) {
                const activePath = document.getElementById(regionId);
                if (activePath) {
                    activePath.classList.add('active');
                    activePath.style.fill = '#E2E9C0';
                    console.log('Région active :', regionId, 'pour le slide', realIndex);
                } else {
                    console.warn('Chemin non trouvé pour la région :', regionId);
                }
            }
        }
        
        // Initialisation du Swiper avec la navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du Swiper principal (celui qui contient les slides de contenu)
            // Réinitialiser les styles des slides avant l'initialisation
            document.querySelectorAll('.swiper-slide.bg-neutral-950').forEach(slide => {
                slide.style.opacity = '0';
                slide.style.transition = 'opacity 0.5s ease';
            });
            
            const swiperInstance = new Swiper('.swiper:has(.swiper-slide.bg-neutral-950)', {
                initialSlide: 0,
                loop: false,
                effect: 'fade',
                fadeEffect: {
                    crossFade: false // Désactiver le crossFade pour éviter les problèmes de superposition
                },
                autoHeight: true,
                watchSlidesProgress: true,
                speed: 500, // Durée de la transition en ms
                preloadImages: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                mousewheel: true,
                on: {
                    init: function() {
                        // Mettre à jour la carte avec le slide initial
                        updateMapForSlide(this.activeIndex);
                        // Afficher le slide initial
                        const slides = document.querySelectorAll('.swiper-slide.bg-neutral-950');
                        slides[this.activeIndex].style.opacity = '1';
                    },
                    slideChange: function() {
                        console.log('Changement de slide vers:', this.activeIndex);
                        updateMapForSlide(this.activeIndex);
                        
                        // Cacher tous les slides
                        const slides = document.querySelectorAll('.swiper-slide.bg-neutral-950');
                        slides.forEach(slide => slide.style.opacity = '0');
                        
                        // Afficher uniquement le slide actif
                        if (slides[this.activeIndex]) {
                            slides[this.activeIndex].style.opacity = '1';
                        }
                    }
                }
            });
            
            // Initialisation du Swiper de navigation (celui avec les noms de régions)
            const navSwiper = new Swiper('.swiper:not(:has(.swiper-slide.bg-neutral-950))', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                freeMode: true,
                watchSlidesProgress: true,
                centeredSlides: false,
                slideToClickedSlide: true,
                on: {
                    click: function(swiper, event) {
                        const clickedSlide = event.target.closest('.swiper-slide');
                        if (clickedSlide) {
                            const slideIndex = parseInt(clickedSlide.getAttribute('data-swiper-slide-index'));
                            swiperInstance.slideTo(slideIndex);
                        }
                    }
                }
            });
            // Lier le swiper principal avec la navigation
            swiperInstance.controller.control = navSwiper;
            navSwiper.controller.control = swiperInstance;
            
            // Gestion des interactions avec la carte
            document.querySelectorAll('#mapContainer svg path').forEach(path => {
                // Style de base pour les chemins
                path.style.cursor = 'pointer';
                path.style.transition = 'fill 0.3s ease';
                
                // Créer un élément SVG pour l'icône de punaise
                const pinIcon = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                pinIcon.setAttribute('class', 'pin-icon');
                pinIcon.innerHTML = `
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="#eab308"/>
                    </svg>
                `;
                pinIcon.style.display = 'none';
                
                // Ajouter l'icône au groupe parent du path
                const parentGroup = path.parentNode;
                parentGroup.appendChild(pinIcon);
                
                // Mettre à jour la position de l'icône
                const updatePinPosition = () => {
                    const bbox = path.getBBox();
                    const x = bbox.x + bbox.width / 2 - 15; // Ajuster pour centrer l'icône
                    const y = bbox.y + bbox.height / 2 - 30; // Ajuster pour positionner au-dessus du centre
                    pinIcon.setAttribute('transform', `translate(${x},${y})`);
                };
                
                // Mettre à jour la position initiale
                updatePinPosition();
                
                // Gestion du clic sur une région
                path.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const regionId = this.id;
                    console.log('Clic sur la région:', regionId);
                    
                    // Mettre à jour la position de l'icône
                    updatePinPosition();
                    // Afficher l'icône
                    pinIcon.style.display = 'block';
                    
                    // Cacher les autres icônes
                    document.querySelectorAll('#mapContainer svg g > g').forEach(group => {
                        if (group !== pinIcon && group.querySelector('svg')) {
                            group.style.display = 'none';
                        }
                    });
                    
                    if (regionId && regionToSlideMap[regionId] !== undefined) {
                        const slideIndex = regionToSlideMap[regionId];
                        console.log('Navigation vers le slide:', slideIndex);
                        
                        // Utiliser l'instance stockée
                        if (swiperInstance) {
                            swiperInstance.slideTo(slideIndex);
                        }
                    }
                });
                
                // Effet de survol
                path.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.fill = '#E2E9C9';
                    }
                });
                
                path.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.fill = '';
                    }
                });
                
                // Mettre à jour la position de l'icône lors du redimensionnement
                window.addEventListener('resize', updatePinPosition);
            });
        });
    </script>
    <x-footer/>

    <!-- Script Typed.js avec couleurs -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <style>
        .typed-text {
            min-height: 2rem;
            display: inline-block;
        }
        .typed-text span {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typedElements = document.querySelectorAll('.typed-text');
            const colors = [
                'text-green-600', // Vert pour la première phrase
                'text-yellow-500', // Jaune pour la deuxième
                'text-red-600',    // Rouge pour la troisième
                'text-green-600', // Vert pour la première phrase
                'text-yellow-500'  // Violet pour la cinquième
            ];
            
            typedElements.forEach(element => {
                const items = JSON.parse(element.getAttribute('data-typed-items'));
                if (items && items.length > 0) {
                    // Ajouter les balises span avec les couleurs
                    const coloredItems = items.map((item, index) => {
                        return `<span class="${colors[index % colors.length]}">${item}</span>`;
                    });
                    
                    const typed = new Typed(element, {
                        strings: coloredItems,
                        typeSpeed: 50,
                        backSpeed: 30,
                        backDelay: 2000,
                        loop: true,
                        showCursor: true,
                        cursorChar: '|',
                        contentType: 'html' // Permet l'utilisation de HTML dans les chaînes
                    });
                }
            });
        });
    </script>
</body>
</html>