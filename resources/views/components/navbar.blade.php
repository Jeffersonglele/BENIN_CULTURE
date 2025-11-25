<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="{{route('home')}}" class="text-black font-bold text-2xl">
            <img src="{{asset('images/logosf.png')}}" alt="CULTURE BENIN" class="h-10 md:h-12 object-contain">
        </a>

        <ul class="hidden md:flex space-x-8 text-black font-medium relative items-center">
            <li><a href="{{route('home')}}" class="hover:text-gray-300">Accueil</a></li>

            <!-- Menu Culture avec sous-menu -->
            <li class="relative group">
                <a href="#culture" class="hover:text-gray-300 flex items-center">Culture
                    <svg class="ml-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Sous-menu -->
                <ul class="absolute left-0 mt-2 w-40 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                    <li><a href="{{route('langue')}}" class="block px-4 py-2 hover:bg-gray-100">Langue</a></li>
                    <li><a href="#regions" class="block px-4 py-2 hover:bg-gray-100">Régions</a></li>
                    <li><a href="#contenus" class="block px-4 py-2 hover:bg-gray-100">Contenus</a></li>
                </ul>
            </li>

            <li><a href="#tourisme" class="hover:text-gray-300">Tourisme</a></li>
            <li><a href="#contact" class="hover:text-gray-300">Contact</a></li>

            <!-- Icône utilisateur + nom si connecté -->
            <li class="flex items-center space-x-2 ml-4">
                <!-- Icône utilisateur (SVG) -->
                <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                </svg>
                @auth
                    <span class="text-yellow-300 font-medium">{{ Auth::user()->name }}</span>
                @endauth
            </li>
        </ul>

        

        <!-- Menu mobile button -->
        <button class="md:hidden text-white">
            ☰
        </button>
    </div>
</nav>
