import './bootstrap';
import Typed from 'typed.js';

// Initialisation de Typed.js
document.addEventListener('DOMContentLoaded', function() {
    const typedElements = document.querySelectorAll('.typed-text');
    
    typedElements.forEach(element => {
        const strings = JSON.parse(element.getAttribute('data-typed-items') || '[]');
        
        if (strings.length > 0) {
            new Typed(element, {
                strings: strings,
                typeSpeed: 50,
                backSpeed: 30,
                backDelay: 2000,
                loop: true,
                showCursor: true,
                cursorChar: '|',
                autoInsertCss: true
            });
        }
    });
});
import Alpine from 'alpinejs';
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';

// Initialisation de Swiper avec navigation personnalisée
function initSwiper() {
    const swiper = new Swiper('.swiper', {
        // Configuration de base
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        
        // Configuration de la navigation personnalisée
        navigation: {
            nextEl: '.custom-swiper-button-next',
            prevEl: '.custom-swiper-button-prev',
        },
        
        // Options supplémentaires
        keyboard: true,
        grabCursor: true,
        
        // Gestion des événements
        on: {
            init: function() {
                // Ajouter la classe active à la première slide
                updateActiveRegion(0);
            },
            slideChange: function() {
                updateActiveRegion(this.activeIndex);
            }
        }
    });

    // Gestion des clics sur les régions de la carte
    document.querySelectorAll('#mapContainer path').forEach((path, index) => {
        path.addEventListener('click', () => {
            // Trouver l'index de la région en fonction de l'ID du path
            const regionIndex = getRegionIndex(path.id || index);
            if (regionIndex !== -1) {
                swiper.slideTo(regionIndex);
            }
        });
    });

    // Mettre à jour la région active
    function updateActiveRegion(slideIndex) {
        // Supprimer la classe active de toutes les régions
        document.querySelectorAll('#mapContainer path').forEach(path => {
            path.classList.remove('active');
        });

        // Ajouter la classe active à la région correspondante
        const regionIndex = slideIndex % 12; // 12 régions au total
        const regionPath = document.querySelector(`#region-${regionIndex}`);
        if (regionPath) {
            regionPath.classList.add('active');
        }
    }

    // Obtenir l'index de la région en fonction de l'ID ou de l'index
    function getRegionIndex(idOrIndex) {
        if (typeof idOrIndex === 'number') {
            return idOrIndex;
        }
        
        // Extraire le numéro de la région depuis l'ID (format: region-0, region-1, etc.)
        const match = idOrIndex.match(/region-(\d+)/);
        return match ? parseInt(match[1], 10) : -1;
    }

    return swiper;
}

// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', () => {
    // Initialiser Swiper
    const swiper = initSwiper();

    // Ajouter des IDs aux régions de la carte si nécessaire
    document.querySelectorAll('#mapContainer path').forEach((path, index) => {
        if (!path.id) {
            path.id = `region-${index}`;
        }
    });
});

window.Alpine = Alpine;
Alpine.start();
