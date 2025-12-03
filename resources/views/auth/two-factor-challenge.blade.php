<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Veuillez confirmer l\'accès à votre compte en entrant le code d\'authentification fourni par votre application d\'authentification.') }}
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="code">
                {{ __('Code d\'authentification') }}
            </label>
            <input type="text" 
                   id="code" 
                   name="code" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   required 
                   autofocus
                   autocomplete="one-time-code"
                   placeholder="Entrez le code à 6 chiffres">
            
            @error('code')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="btn-1">
                <span class="text">{{ __('Se connecter') }}</span>
                <div class="circle"></div>
                <svg class="arr-1" viewBox="0 0 24 24">
                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
                <svg class="arr-2" viewBox="0 0 24 24">
                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
            </button>

            <a href="{{ route('two-factor.recovery') }}" class="text-sm text-gray-600 hover:text-gray-900">
                {{ __('Utiliser un code de récupération') }}
            </a>
        </div>
    </form>

    <style>
        .btn-1 {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 32px;
            border: 3px solid transparent;
            font-size: 14px;
            background-color: #000000;
            border-radius: 100px;
            font-weight: 500;
            color: #ffffff;
            box-shadow: 0 0 0 2px #000000;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 15px;
            height: 15px;
            background-color: #c57e0bff;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            z-index: 1;
        }

        .btn-1 .text {
            position: relative;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            color: #ffffff;
        }

        .btn-1 svg {
            position: relative;
            width: 18px;
            height: 18px;
            fill: #ffffff;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            flex-shrink: 0;
        }

        /* Flèche droite visible par défaut */
        .btn-1 .arr-1 {
            opacity: 1;
            transform: translateX(0);
        }

        /* Flèche gauche cachée par défaut */
        .btn-1 .arr-2 {
            opacity: 0;
            transform: translateX(-10px);
            position: absolute;
            left: 20px;
        }

        .btn-1:hover {
            box-shadow: 0 0 0 8px transparent;
            border-radius: 12px;
            background-color: #000000;
            padding-left: 40px;
            padding-right: 40px;
        }

        .btn-1:hover .arr-1 {
            opacity: 0;
            transform: translateX(10px);
        }

        .btn-1:hover .arr-2 {
            opacity: 1;
            transform: translateX(0);
            left: 20px;
        }

        .btn-1:hover .text {
            transform: translateX(8px);
            color: #ffffff;
        }

        .btn-1:hover .circle {
            width: 180px;
            height: 180px;
            opacity: 1;
        }

        .btn-1:active {
            transform: scale(0.95);
            box-shadow: 0 0 0 3px #c57e0bff;
        }

        /* Support pour le thème sombre */
        .dark .btn-1 {
            background-color: #1a1a1a;
            box-shadow: 0 0 0 2px #1a1a1a;
        }

        .dark .btn-1:hover {
            background-color: #1a1a1a;
        }

        /* Ajustement pour l'alignement dans le flex */
        .flex.items-center.justify-between {
            align-items: center;
        }
    </style>
</x-guest-layout>