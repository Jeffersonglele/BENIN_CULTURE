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
            --secondary: #D4AF37;
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
            transition: all 0.4s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.15);
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

    <!-- Section Héro avec effet de verre amélioré -->
    <section class="relative min-h-screen flex items-center justify-center px-6 py-32 overflow-hidden">
        <!-- Video background optionnel -->
        < <video autoplay muted loop class="absolute inset-0 object-cover w-full h-full z-0">
            <source src="{{ asset('videos/DJI_0142_2 (1).mp4') }}" type="video/mp4">
        </video>
        
        <div class="relative z-10 max-w-4xl p-12 rounded-2xl text-white ml-0 md:ml-16 lg:ml-32">
            <div class="fade-in-left" style="animation-delay: 0.3s">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-left">
                    Découvrez <span class="text-yellow-300">Un monde</span> de Splendeurs
                </h1>
                <p class="text-xl md:text-2xl font-light mb-8 leading-relaxed text-left max-w-2xl">
                    Plongez au cœur d'une terre millénaire où histoire, culture et nature se rencontrent pour créer une expérience inoubliable.
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <a href="#histoire" class="text-white text-4xl">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Section Histoire -->
    <section id="histoire" class="py-24 bg-white">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="relative group animate-fadeIn delay-100">
                <img src="{{asset('images/Photo 13 FM.jpg')}}" alt="Histoire du Bénin" 
                     class="rounded-2xl shadow-xl hover-scale group-hover:shadow-2xl">
                <div class="absolute -inset-4 border-2 border-yellow-400 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            
            <div class="animate-fadeIn delay-200">
                <span class="text-yellow-500 font-semibold">Notre Héritage</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title">L'Histoire Fascinante du Bénin</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Berceau des anciens royaumes de Dahomey et de Porto-Novo, le Bénin regorge de récits épiques et de traditions séculaires. Des palais royaux d'Abomey aux vestiges de Ouidah, chaque pierre raconte une histoire.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <span class="text-yellow-500 mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>12ème siècle : Émergence des premiers royaumes</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-500 mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>17ème siècle : Apogée du royaume du Dahomey</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-500 mt-1 mr-2"><i class="fas fa-check-circle"></i></span>
                        <span>1960 : Indépendance du Bénin</span>
                    </li>
                </ul>
                <a href="#" class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-medium">
                    En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Culture -->
    <section id="culture" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="order-2 md:order-1 animate-fadeIn delay-200">
                <span class="text-yellow-500 font-semibold">Notre Identité</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title">Une Culture Vivante et Envoûtante</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Le Bénin est le berceau du Vodoun, classé au patrimoine mondial de l'UNESCO. Ses festivals colorés, ses danses traditionnelles et son artisanat unique en font une destination culturelle incontournable.
                </p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-yellow-500 text-2xl mb-2"><i class="fas fa-music"></i></div>
                        <h4 class="font-semibold">Festivals</h4>
                        <p class="text-sm text-gray-600">Vibrants et spirituels</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-yellow-500 text-2xl mb-2"><i class="fas fa-hands"></i></div>
                        <h4 class="font-semibold">Artisanat</h4>
                        <p class="text-sm text-gray-600">Savoir-faire ancestral</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-yellow-500 text-2xl mb-2"><i class="fas fa-utensils"></i></div>
                        <h4 class="font-semibold">Cuisine</h4>
                        <p class="text-sm text-gray-600">Saveurs authentiques</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="text-yellow-500 text-2xl mb-2"><i class="fas fa-mask"></i></div>
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
    <section id="explore" class="py-24 bg-white">
        <div class="container mx-auto px-12">
            <div class="text-center max-w-2xl mx-auto mb-16 animate-fadeIn">
                <span class="text-yellow-500 font-semibold">Explorer</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 section-title mx-auto">Diversité Touristique</h2>
                <p class="text-xl text-gray-600">
                Découvrez le Bénin, où chaque plage, lagune et paysage naturel se conjugue à une richesse culturelle et artistique, offrant un voyage touristique exceptionnel.
                </p>
            </div>
            
            <div class="flex overflow-x-auto gap-8 pb-8 scroll-gallery snap-x snap-mandatory">
                <?php 
                $landmarks = [
                    ["Art contemporain du Bénin", "Ouidah", "images/EXPO.jpg"],
                    ["Palais Royal d'Abomey", "Abomey", "images/abomey.png"],
                    ["Parc National de la Pendjari", "Atacora", "images/pendjari.png"],
                    ["Ganvié", "La Cité Lacustre du Bénin", "images/photo-ganvie.png"],
                    ["Porte du non retour", "Ouidah", "images/pnr.png"]
                ];
                
                foreach($landmarks as $landmark): ?>
                    <div class="snap-center shrink-0 w-80 h-96 rounded-2xl overflow-hidden shadow-lg card-hover relative group">
                        <img src="{{ asset($landmark[2]) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6">
                            <h3 class="text-2xl font-bold text-white mb-1"><?= $landmark[0] ?></h3>
                            <p class="text-yellow-300 font-medium"><?= $landmark[1] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

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
                <a href="../app_php/pages/contact.php" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                    <i class="fas fa-phone-alt mr-2"></i> Nous Appeler
                </a>
                <a href="../app_php/pages/contact.php" class="px-8 py-4 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium rounded-full transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
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

<!--?php include('includes/footer.php'); ? -->

</body>
</html>