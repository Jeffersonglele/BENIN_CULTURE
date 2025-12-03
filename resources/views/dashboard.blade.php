<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} !</h3>
                    <p class="mt-2 text-gray-600">Vous êtes connecté en tant que {{ Auth::user()->role->nom_role ?? 'Administrateur' }}.</p>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Votre compte a été créé avec succès. Profitez de notre plateforme !
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Vos informations</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->name}}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Date d'inscription</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ Auth::user()->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>

                    <a href="{{ route('admin.culture') }}" class="btn-1">
                        <span class="text-black dark:text-black">Voir les statistiques avancées</span>
                        <div class="circle"></div>
                        <svg class="arr-1" viewBox="0 0 24 24">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                        <svg class="arr-2" viewBox="0 0 24 24">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                    </a>
            </div>
        </div>
    </div>

    <style>
        .btn-1 {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 16px 36px;
            border: 4px solid;
            border-color: transparent;
            font-size: 18px;
            background-color: inherit;
            border-radius: 100px;
            font-weight: 400;
            color: #f9f9f9;
            box-shadow: 0 0 0 2px #E2E9C0;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            text-decoration: none;
        }

        .btn-1 svg {
            position: absolute;
            width: 24px;
            fill: #1e1e1e;
            z-index: 9;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .arr-1 {
            right: 16px;
        }

        .btn-1 .arr-2 {
            left: -25%;
        }

        .btn-1 .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #E2E9C0;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .text {
            position: relative;
            z-index: 1;
            transform: translateX(-12px);
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1:hover {
            box-shadow: 0 0 0 12px transparent;
            border-radius: 12px;
        }

        .btn-1:hover .arr-1 {
            right: -25%;
        }

        .btn-1:hover .arr-2 {
            left: 16px;
        }

        .btn-1:hover .text {
            transform: translateX(12px);
        }

        .btn-1 svg {
            fill: #f9f9f9;
        }

        .btn-1:hover svg {
            fill: #f9f9f9;
        }

        .btn-1:active {
            transform: scale(0.95);
            box-shadow: 0 0 0 4px #E2E9C0;
        }

        .btn-1:hover .circle {
            width: 220px;
            height: 220px;
            opacity: 1;
        }
    </style>
</x-app-layout>