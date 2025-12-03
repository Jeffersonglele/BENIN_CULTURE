<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi | CULTURE BENIN</title>
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
                        success: '#10b981', // Vert émeraude pour le succès
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

    <div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl p-8 md:p-12 text-center border-t-8 border-success">
        
        <div class="mb-6 flex justify-center">
            <div class="bg-success/10 p-4 rounded-full inline-flex">
                <i class="fas fa-check-circle text-success text-6xl animate-bounce-in"></i>
            </div>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Paiement Réussi !
        </h1>

        <p class="text-xl text-gray-700 mb-8 leading-relaxed">
            Félicitations ! Votre achat pour le contenu **"{{ $contenu->titre ?? 'Culture Béninoise' }}"** a été validé avec succès.
        </p>

        <div class="bg-gray-50 p-6 rounded-xl mb-10 border border-gray-200">
            <div class="flex justify-between text-lg mb-2">
                <span class="text-gray-600 font-medium">Montant payé :</span>
                <span class="text-gray-900 font-bold">1 000 XOF</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Référence de la transaction :</span>
                <span class="text-gray-800 font-mono">{{ $transaction_ref ?? 'FED-XXXX-XXXX' }}</span>
            </div>
        </div>

        <a href="{{ route('contenu', $contenu->slug ?? '/') }}" 
           class="btn-1 inline-flex items-center group">
            <span class="text">Accéder au Contenu</span>
            <div class="circle"></div>
            <svg class="arr-1" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
            <svg class="arr-2" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
        </a>

        <p class="mt-8 text-sm text-gray-500">
            Un problème ? Contactez notre <a href="#" class="text-primary hover:underline font-medium">support client</a>.
        </p>

    </div>

    <style>
        /* Animation simple pour l'icône */
        @keyframes bounce-in {
            0% { transform: scale(0.5); opacity: 0; }
            70% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-bounce-in {
            animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
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