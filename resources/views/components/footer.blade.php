<footer class="bg-black text-gray-300 pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">

        <!-- LOGO + DESCRIPTION -->
        <div>
            <img src="{{ asset('images/logosf.png') }}" alt="Logo" class="h-14 mb-4">
            <p class="text-sm leading-6">
                Plateforme numérique dédiée à la promotion de la culture, des langues,
                du tourisme et du patrimoine du Bénin.
            </p>
        </div>

        <!-- liens rapides -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">Liens rapides</h3>
            <ul class="space-y-3">
                <li><a href="{{ route('home') }}" class="hover:text-yellow-400">Accueil</a></li>
                <li><a href="#culture" class="hover:text-yellow-400">Culture</a></li>
                <li><a href="{{route('tourisme') }}" class="hover:text-yellow-400">Tourisme</a></li>
                <li><a href="{{route('contact')}}" class="hover:text-yellow-400">Contact</a></li>
            </ul>
        </div>

        <!-- culture -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">Culture</h3>
            <ul class="space-y-3">
                <li><a href="{{ route('langue') }}" class="hover:text-yellow-400">Langues</a></li>
                <li><a href="{{ route('region') }}" class="hover:text-yellow-400">Régions</a></li>
                <li><a href="{{ route('contenu') }}" class="hover:text-yellow-400">Contenus</a></li>
                <!--li><a href="#histoire" class="hover:text-yellow-400">A Propos</a></li -->
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">Contact</h3>
            <p class="text-sm mb-2">Email : jeffglele@gmail.com</p>
            <p class="text-sm mb-4">Téléphone : +229 90 07 71 39</p>

            <!-- réseaux sociaux -->
            <div class="flex space-x-4 mt-4">
                <a href="#" class="text-gray-400 hover:text-yellow-400 text-xl"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 text-xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 text-xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 text-xl"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center text-gray-500 text-sm mt-10 border-t border-gray-700 pt-4">
        © {{ date('Y') }} Culture & Tourisme Bénin — Tous droits réservés.
    </div>
</footer>
