# Application Culture Bénin

Application web de gestion du patrimoine culturel béninois développée avec Laravel.

## Table des matières

- [À propos](#à-propos)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Authentification](#authentification)
- [Gestion des rôles](#gestion-des-rôles)
- [Personnalisation](#personnalisation)
- [Structure du projet](#structure-du-projet)
- [Commandes Artisan](#commandes-artisan)

## À propos

L'Application Culture Bénin est une plateforme de gestion complète du patrimoine culturel béninois, permettant l'administration des données culturelles, des utilisateurs et du contenu patrimonial.

## Prérequis

- **PHP** 8.1 ou supérieur
- **Composer** 
- **Node.js** et **NPM**
- **Base de données** MySQL ou PostgreSQL
- **Serveur web** Apache ou Nginx

## 🚀 Installation

### 1. Cloner le dépôt
```bash
git clone https://github.com/Jeffersonglele/CULTURE_BENIN.git
cd CULTURE_BENIN
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Installer les dépendances JavaScript
```bash
npm install
npm run build
# ou pour le développement
npm run dev
```

### 4. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configuration de la base de données
Éditez le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=culture_benin
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Exécuter les migrations
```bash
php artisan migrate
```

### 7. Démarrer le serveur
```bash
php artisan serve
```

## Authentification

L'application utilise Laravel Breeze pour l'authentification.

### Pages d'authentification disponibles :
- `/register` - Inscription
- `/login` - Connexion  
- `/forgot-password` - Réinitialisation du mot de passe
- `/reset-password` - Nouveau mot de passe

### Utilisation de l'authentification :
```php
// Obtenir l'utilisateur connecté
Auth::user();

// Protéger les routes
Route::middleware(['auth'])->group(function () {
    // Routes protégées
});
```

## Gestion des rôles

Le système inclut une gestion des rôles (user/admin).

### 1. Ajouter la colonne rôle
```bash
php artisan make:migration add_role_to_users_table --table=users
```

Dans la migration :
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['user', 'admin'])->default('user');
    });
}
```

### 2. Mettre à jour le modèle User
```php
// Dans app/Models/User.php
protected $fillable = [
    'name', 'email', 'password', 'role'
];

public function isAdmin()
{
    return $this->role === 'admin';
}
```

### 3. Middleware de vérification des rôles
```bash
php artisan make:middleware CheckRole
```

Dans `app/Http/Middleware/CheckRole.php` :
```php
public function handle($request, Closure $next, $role)
{
    if (!auth()->check() || auth()->user()->role !== $role) {
        abort(403, 'Accès non autorisé');
    }
    return $next($request);
}
```

### 4. Enregistrer le middleware
Dans `app/Http/Kernel.php` :
```php
protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\CheckRole::class,
];
```

### 5. Utilisation dans les routes
```php
// Routes administrateur
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

// Routes utilisateur
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### 6. Vérification dans les vues
```blade
@auth
    @if(auth()->user()->isAdmin())
        <a href="/admin/dashboard">Tableau de bord admin</a>
    @else
        <a href="/dashboard">Mon compte</a>
    @endif
@endauth
```

### 7. Formulaire d'inscription
Dans `app/Http/Controllers/Auth/RegisteredUserController.php` :
```php
protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'user' // Rôle par défaut
    ]);
}
```

## Personnalisation

### Personnaliser les vues d'authentification
- Modifiez les fichiers dans `resources/views/auth/`
- Personnalisez la mise en page dans `resources/views/layouts/`

### Layouts disponibles
- `guest.blade.php` - Layout pour pages non authentifiées
- `app.blade.php` - Layout pour pages authentifiées

### Logo de l'application
Pour modifier le logo, éditez :
```bash
resources/views/components/application-logo.blade.php
```

## Commandes Artisan

### Commandes de développement

#### Création de Modèles
```bash
# Créer un modèle simple
php artisan make:model Patrimoine

# Créer un modèle avec migration, factory et seeder
php artisan make:model Culture -mfs

# Créer un modèle avec contrôleur et migration
php artisan make:model Tradition -mc

# Créer un modèle avec toutes les ressources
php artisan make:model Artisanat -a
```

#### Création de Contrôleurs
```bash
# Contrôleur simple
php artisan make:controller PatrimoineController

# Contrôleur Resource (CRUD complet)
php artisan make:controller CultureController --resource

# Contrôleur API Resource
php artisan make:controller TraditionController --api

# Contrôleur avec modèle
php artisan make:controller ArtisanatController --model=Artisanat
```

#### Création de Middlewares
```bash
# Créer un middleware
php artisan make:middleware AdminMiddleware
php artisan make:middleware CheckPermission
php artisan make:middleware LocalizationMiddleware
```

#### Gestion du Kernel
```bash
# Voir les middlewares enregistrés
php artisan route:list --middleware

# Vider le cache du kernel
php artisan config:clear
php artisan cache:clear
```

#### Création de Migrations
```bash
# Migration simple
php artisan make:migration create_patrimoines_table

# Migration pour modifier une table
php artisan make:migration add_description_to_cultures_table --table=cultures

# Migration avec création de table
php artisan make:migration create_traditions_table --create=traditions
```

#### Création de Seeders et Factories
```bash
# Créer un seeder
php artisan make:seeder PatrimoineSeeder
php artisan make:seeder CultureSeeder

# Créer une factory
php artisan make:factory PatrimoineFactory --model=Patrimoine

# Exécuter les seeders
php artisan db:seed
php artisan db:seed --class=PatrimoineSeeder
```

#### Création de Policies et Gates
```bash
# Créer une policy
php artisan make:policy PatrimoinePolicy --model=Patrimoine
php artisan make:policy CulturePolicy

# Enregistrer les policies dans AuthServiceProvider
# puis utiliser dans les contrôleurs
```

#### Création de Events et Listeners
```bash
# Créer un event
php artisan make:event PatrimoineCreated

# Créer un listener
php artisan make:listener SendPatrimoineNotification --event=PatrimoineCreated

# Créer un observer
php artisan make:observer PatrimoineObserver --model=Patrimoine
```

#### Création de Jobs et Notifications
```bash
# Créer un job
php artisan make:job ProcessPatrimoineImage

# Créer une notification
php artisan make:notification PatrimoineApprouved

# Créer une mail
php artisan make:mail PatrimoineReport
```

### Commandes de gestion

#### Base de données
```bash
# Exécuter les migrations
php artisan migrate

# Rollback de migration
php artisan migrate:rollback

# Recréer toute la base de données
php artisan migrate:fresh --seed

# Status des migrations
php artisan migrate:status
```

#### Cache et Optimisation
```bash
# Vider tous les caches
php artisan optimize:clear

# Cache de la configuration
php artisan config:cache

# Cache des routes
php artisan route:cache

# Cache des vues
php artisan view:cache
```

#### Génération de clés et sécurité
```bash
# Générer une clé d'application
php artisan key:generate

# Créer un lien de stockage
php artisan storage:link

# Générer une clé Passport
php artisan passport:keys
```

#### Maintenance
```bash
# Mode maintenance
php artisan down

# Retour en ligne
php artisan up

# Mode maintenance avec secret
php artisan down --secret="mon-secret"
```

### Commandes de débogage

#### Inspection
```bash
# Lister toutes les routes
php artisan route:list

# Voir les variables d'environnement
php artisan env

# Tester les emails
php artisan tinker
# puis : Mail::to('test@test.com')->send(new \App\Mail\TestMail());
```

#### Logs et debugging
```bash
# Voir les logs en temps réel
tail -f storage/logs/laravel.log

# Effacer les logs
php artisan log:clear

# Surveillance des requêtes
php artisan serve
```

## Structure du projet

```
CULTURE_BENIN/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── public/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   ├── layouts/
│   │   └── components/
│   └── css/
└── routes/
```
…or create a new repository on the command line
echo "# CULTURE" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/Jeffersonglele/CULTURE.git
git push -u origin main
…or push an existing repository from the command line
git remote add origin https://github.com/Jeffersonglele/CULTURE.git
git branch -M main
git push -u origin main

php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

php artisan migrate --path=/database/migrations/2025_11_25_194210_create_login_histories_table.php
>> 

Breeze
barrydh

maurice.comlan@uac.bj
Eneam123

NONCES CSP
