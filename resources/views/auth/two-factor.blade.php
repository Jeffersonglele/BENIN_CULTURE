<x-guest-layout>
    <h2 class="text-xl font-bold mb-4">Activer la double authentification</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if (!auth()->user()->two_factor_secret)
        <p class="mb-4">Cliquez sur le bouton ci-dessous pour générer votre QR Code et activer l'authentification à deux facteurs.</p>

        <form method="POST" action="{{ route('two-factor.enable') }}" class="text-center">
            @csrf
            <button type="submit" class="btn-1">
                <span class="text">Générer le QR Code</span>
                <div class="circle"></div>
                <svg class="arr-1" viewBox="0 0 24 24">
                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
                <svg class="arr-2" viewBox="0 0 24 24">
                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
            </button>
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
                margin: 0 auto;
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
        </style>
    @else
        <p class="mb-4">Scannez ce QR Code avec Google Authenticator ou Authy :</p>
        <div class="mb-4 flex justify-center">
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>

        @if(auth()->user()->two_factor_recovery_codes)
            <p class="mb-2 text-gray-600">Codes de récupération :</p>
            <ul class="bg-gray-100 p-4 rounded mb-4">
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                    <li>{{ $code }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('two-factor.confirm') }}">
            @csrf
            <label for="code" class="block font-medium text-gray-700 mb-1">Entrez le code OTP :</label>
            <input type="text" name="code" id="code" class="border p-2 w-full rounded mb-4" required autofocus autocomplete="one-time-code">

            @error('code')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror

            <div class="text-center">
    <button type="submit" class="btn-1">
        <span class="text">Confirmer l'activation</span>
        <div class="circle"></div>
        <svg class="arr-1" viewBox="0 0 24 24">
            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
        </svg>
        <svg class="arr-2" viewBox="0 0 24 24">
            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
        </svg>
    </button>
</div>

<style>
    .btn-1 {
        position: relative;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 40px 12px 32px;
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
        margin: 0 auto;
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
        position: absolute;
        width: 18px;
        height: 18px;
        fill: #ffffff;
        z-index: 2;
        transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    /* Flèche droite visible par défaut à droite */
    .btn-1 .arr-1 {
        right: 16px;
        opacity: 1;
    }

    /* Flèche gauche cachée par défaut à gauche */
    .btn-1 .arr-2 {
        left: -25%;
        opacity: 0;
    }

    .btn-1:hover {
        box-shadow: 0 0 0 8px transparent;
        border-radius: 12px;
        background-color: #000000;
        padding: 12px 32px 12px 40px;
    }

    .btn-1:hover .arr-1 {
        right: -25%;
        opacity: 0;
    }

    .btn-1:hover .arr-2 {
        left: 16px;
        opacity: 1;
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
</style>
        </form>
    @endif
</x-guest-layout>