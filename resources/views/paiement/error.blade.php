<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur de Paiement | CULTURE BENIN</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        // Configuration Tailwind pour la police Space Grotesk et les couleurs
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        // Utilise Space Grotesk comme police par défaut
                        sans: ['Space Grotesk', 'sans-serif'], 
                    },
                    colors: {
                        primary: '#c57e0bff', // Votre couleur primaire
                        dark: '#1a1a1a', 
                        error: '#ef4444', // Rouge pour l'erreur (red-500)
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl p-8 md:p-12 text-center border-t-8 border-error">
        
        <div class="mb-6 flex justify-center">
            <div class="bg-error/10 p-4 rounded-full inline-flex">
                <i class="fas fa-exclamation-triangle text-error text-6xl animate-shake"></i>
            </div>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Aïe ! Le Paiement a Échoué.
        </h1>

        <p class="text-xl text-gray-700 mb-8 leading-relaxed">
            La transaction pour l'achat de {{ $contenus->titre ?? 'ce contenu' }} n'a pas pu être finalisée.
        </p>
        
        <div class="bg-red-50 p-6 rounded-xl mb-10 border border-red-200 text-left">
            <h3 class="text-lg font-semibold text-error mb-3 flex items-center">
                <i class="fas fa-lightbulb mr-2"></i> Que faire maintenant ?
            </h3>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><i class="fas fa-credit-card mr-2 text-primary"></i> Vérifiez les informations de paiement (numéro, expiration, solde).</li>
                <li><i class="fas fa-redo-alt mr-2 text-primary"></i> Réessayez le paiement avec un autre moyen si possible.</li>
                <li><i class="fas fa-mobile-alt mr-2 text-primary"></i> Assurez-vous d'avoir validé l'action de paiement sur votre téléphone (mobile money).</li>
            </ul>
        </div>

        <a href="{{ route('contenu', $contenu->slug ?? '/') }}" 
           onclick="window.history.back();"
           class="btn-1 inline-flex items-center group">
            <span class="text">Réessayer le Paiement</span>
            <div class="circle"></div>
            <svg class="arr-1" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
            <svg class="arr-2" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
        </a>

        <p class="mt-8 text-sm text-gray-500">
            Si le problème persiste, contactez notre <a href="#" class="text-primary hover:underline font-medium">support client</a> immédiatement.
        </p>

    </div>

    <style>
        /* Animation simple pour l'icône d'erreur */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out 1;
        }

        /* Réutilisation et adaptation du style btn-1 de votre code précédent */
        .btn-1 {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 32px;
            border: 3px solid transparent;
            font-size: 14px;
            background-color: #c57e0bff; /* Utilisez primary pour l'action principale */
            border-radius: 100px;
            font-weight: 500;
            color: #ffffff;
            box-shadow: 0 0 0 2px #c57e0bff;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            text-decoration: none;
        }

        .btn-1 .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 15px;
            height: 15px;
            background-color: #000000; /* Couleur d'effet hover */
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

        .btn-1 .arr-1 {
            right: 16px;
            opacity: 1;
        }

        .btn-1 .arr-2 {
            left: -25%;
            opacity: 0;
        }

        .btn-1:hover {
            box-shadow: 0 0 0 8px transparent;
            border-radius: 12px;
            background-color: #c57e0bff;
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
    </style>

</body>
</html>