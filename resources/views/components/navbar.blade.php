<nav class="absolute top-0 left-0 w-full z-50 bg-transparent">
    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-white font-bold">
            <img src="{{ asset('images/logosf.png') }}" alt="CULTURE BENIN"
                 class="h-14 md:h-16 lg:h-20 object-contain transition-all duration-300 hover:scale-105">
        </a>

        <!-- Menu Desktop -->
        <ul class="hidden md:flex space-x-10 text-white text-lg font-semibold items-center">

            <!-- Culture + dropdown -->
            <li class="relative group">
                <button class="flex items-center hover:text-yellow-300 duration-200">
                    Culture
                    <svg class="ml-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Sous-menu -->
                <ul class="absolute left-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md 
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                           transition-all duration-300 pt-2 pb-2 pointer-events-auto">
                    <li><a href="{{ route('langue') }}" class="block px-4 py-2 hover:bg-gray-100">Langue</a></li>
                    <li><a href="{{ route('region') }}" class="block px-4 py-2 hover:bg-gray-100">Régions</a></li>
                    <li><a href="{{ route('contenu') }}" class="block px-4 py-2 hover:bg-gray-100">Contenus</a></li>
                </ul>
            </li>

            <li><a href="{{ route('tourisme') }}" class="hover:text-yellow-300 duration-200">Tourisme</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-yellow-300 duration-200">Contact</a></li>

            <!-- Utilisateur -->
            <li class="relative group">
                <div class="flex items-center space-x-2 cursor-pointer hover:text-yellow-300 duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>

                    @auth
                        <span class="text-yellow-300 font-semibold">{{ Auth::user()->name }}</span>
                    @endauth
                </div>

                <ul class="absolute right-0 mt-2 w-40 bg-white text-gray-800 shadow-lg rounded-md 
                           opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                           transition-all duration-300 pt-2 pb-2">
                    @guest
                        <li><a href="{{ route('author.login') }}" class="block px-4 py-2 hover:bg-gray-100">Log In</a></li>
                    @endguest
                    @auth
                        <li><a href="{{ route('author.logout') }}" class="block px-4 py-2 hover:bg-gray-100">Log Out</a></li>
                    @endauth
                </ul>
            </li>
        </ul>

        <!-- Hamburger mobile -->
        <button id="mobileMenuButton" class="md:hidden text-white text-3xl focus:outline-none">
            ☰
        </button>

    </div>

    <!-- Menu Mobile -->
    <div id="mobileMenu" class="md:hidden hidden bg-gray-800 bg-opacity-95 text-white">
        <ul class="flex flex-col space-y-3 px-6 py-4">
            <li class="relative">
                <button class="w-full flex justify-between items-center hover:text-yellow-300 duration-200" onclick="toggleSubMenu('cultureMobile')">
                    Culture
                    <svg class="ml-1 w-3 h-3 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <ul id="cultureMobile" class="hidden flex-col mt-2 space-y-1 pl-4">
                    <li><a href="{{ route('langue') }}" class="block px-4 py-2 hover:bg-gray-700 rounded-md">Langue</a></li>
                    <li><a href="{{ route('region') }}" class="block px-4 py-2 hover:bg-gray-700 rounded-md">Régions</a></li>
                    <li><a href="{{ route('contenu') }}" class="block px-4 py-2 hover:bg-gray-700 rounded-md">Contenus</a></li>
                </ul>
            </li>
            <li><a href="{{ route('tourisme') }}" class="block hover:text-yellow-300">Tourisme</a></li>
            <li><a href="{{ route('contact') }}" class="block hover:text-yellow-300">Contact</a></li>
            <li class="relative">
                <button class="w-full flex justify-between items-center hover:text-yellow-300 duration-200" onclick="toggleSubMenu('userMobile')">
                    @auth {{ Auth::user()->name }} @else Utilisateur @endauth
                </button>
                <ul id="userMobile" class="hidden flex-col mt-2 space-y-1 pl-4">
                    @guest
                        <li><a href="{{ route('author.login') }}" class="block px-4 py-2 hover:bg-gray-700 rounded-md">Log In</a></li>
                    @endguest
                    @auth
                        <li><a href="{{ route('author.logout') }}" class="block px-4 py-2 hover:bg-gray-700 rounded-md">Log Out</a></li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>

</nav>

<script>
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    function toggleSubMenu(id) {
        const menu = document.getElementById(id);
        menu.classList.toggle('hidden');
    }
</script>
