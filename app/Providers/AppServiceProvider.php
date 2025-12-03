<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Initialisation de FedaPay avec la clé secrète
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret_key'));

        // Mode sandbox ou live (live quand tu seras prêt)
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.mode', 'live'));
    }
}
