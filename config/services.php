<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'fedapay' => [
        /*
        |--------------------------------------------------------------------------
        | FedaPay Configuration
        |--------------------------------------------------------------------------
        |
        | Cette section contient les paramètres de configuration pour l'intégration
        | avec l'API FedaPay. Assurez-vous de définir les variables d'environnement
        | correspondantes dans votre fichier .env
        |
        */
        'public_key' => env('FEDAPAY_PUBLIC_KEY'),
        'secret_key' => env('FEDAPAY_SECRET_KEY'),
        'mode' => env('FEDAPAY_MODE', 'live'), // 'test' ou 'live'
        'webhook_secret' => env('FEDAPAY_WEBHOOK_SECRET'),
        'currency' => 'XOF', // Devise par défaut
        'country' => 'bj',   // Code pays par défaut (BJ pour le Bénin)
        'default_amount' => 100, // Montant par défaut en centimes (10.00 FCFA)
    ],

];
