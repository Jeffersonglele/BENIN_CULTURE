
<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    
    <!-- Google Fonts - Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    
    <style>
        /* Import de la police */
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
        
        /* Application de la police à tout le document */
        html {
            font-size: 15px; /* Taille de base réduite */
        }
        
        body, 
        body *:not(i):not(.bi):not(.fa) {
            font-family: 'Space Grotesk', sans-serif !important;
            font-size: 0.95rem; /* Taille de police légèrement réduite */
            line-height: 1.4; /* Interlignage ajusté */
        }
        
        /* Surcharge pour les éléments spécifiques qui pourraient avoir des styles en dur */
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6,
        .card-title, .nav-link, .btn,
        .form-control, .form-label, .form-select,
        .table, .table th, .table td {
            font-family: 'Space Grotesk', sans-serif !important;
        }
        
        /* Styles pour le menu latéral */
        .app-sidebar {
            width: 250px;
            transition: all 0.3s;
            overflow-y: auto;
        }
        
        /* Style des éléments du menu */
        .nav-sidebar > .nav-item {
            margin-bottom: 4px;
        }
        
        /* Style des liens du menu */
        .nav-sidebar .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin: 0.15rem 0.5rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }
        
        /* Style des sous-menus */
        .nav-sidebar .nav-treeview {
            padding-left: 1.5rem;
        }
        
        /* Style des icônes du menu */
        .nav-sidebar .nav-icon {
            margin-right: 0.5rem;
            width: 1.25rem;
            text-align: center;
            color: #000 !important;
        }
        
        /* Style des flèches des menus déroulants */
        .nav-sidebar .nav-link > .float-end {
            margin-top: 0.25rem;
            margin-left: auto;
        }
        
        /* Espacement entre les éléments du menu */
        .nav-sidebar .nav-item > .nav-link {
            margin-bottom: 4px;
        }
        
        /* Amélioration de la visibilité des sous-menus */
        .nav-treeview {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 0.25rem;
            margin: 0.25rem 0;
            padding: 0.25rem 0;
        }
        
        /* Style au survol des éléments du menu */
        .nav-sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        /* Style pour l'élément actif */
        .nav-sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #000 !important;
        }
        
        /* Animation fadeInLeft */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Classe utilitaire pour l'animation */
        .animate-fade-in-left {
            animation: fadeInLeft 0.5s ease-out forwards;
        }
    </style>
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{asset('adminlte/css/adminlte.css')}}" as="style" />
    <!--end::Accessibility Features-->
    @stack('styles')
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.css')}}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
        crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('adminlte/css/custom.css')}}" />  
    <link rel="stylesheet" href="{{asset('adminlte/css/svg.css')}}" />  
      
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search text-dark"></i>
                        </a>
                    </li>
                    <!--end::Navbar Search-->
                    
                    <!--end::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen text-dark"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img
                                src="{{asset('images/users.jpg')}}"
                                class="user-image rounded-circle shadow"
                                alt="User Image" />
                            <span class="d-none d-md-inline text-black">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{url('/')}}" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                        src="{{asset('images/logosf.png')}}"
                        alt="culture"
                        class="brand-image w-64 h-64" />
                    <!--end::Brand Image-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul
                        class="nav nav-pills nav-sidebar flex-column"
                        data-lte-toggle="treeview"
                        role="menu"
                        data-accordion="false">
                        <!-- Menu Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.culture') }}" class="nav-link">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p class="text-black">Dashboard</p>
                            </a>
                        </li>

                        <!-- Menu Utilisateurs -->
                        <li class="nav-item">
                            <a href="{{ route('admin.utilisateurs.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p class="text-black">
                                    Utilisateurs
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <!--ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.utilisateurs.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-people"></i>
                                        <p>Liste des Auteurs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.utilisateurs.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-person-badge"></i>
                                        <p>Liste des Traducteurs</p>
                                    </a>
                                </li>
                            </ul -->
                        </li>

                        <!-- Menu Langues -->
                        <li class="nav-item">
                            <a href="{{ route('admin.langues.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-translate"></i>
                                <p class="text-black">Langues</p>
                            </a>
                        </li>

                        <!-- Menu Régions -->
                        <li class="nav-item">
                            <a href="{{ route('admin.regions.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-geo-alt-fill"></i>
                                <p class="text-black">Régions</p>
                            </a>
                        </li>

                        <!-- Menu Contenus -->
                        <li class="nav-item">
                            <a href="{{ route('admin.contenus.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-collection-fill"></i>
                                <p class="text-black">
                                    Contenus
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <!--ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.contenus.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-check-circle"></i>
                                        <p>Validés</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.contenus.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-x-circle"></i>
                                        <p>Non Validés</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.contenus.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-hourglass"></i>
                                        <p>En Attente</p>
                                    </a>
                                </li>
                            </ul>-->
                        </li>

                        <!-- Menu Médias -->
                        <li class="nav-item">
                            <a href="{{ route('admin.medias.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-images"></i>
                                <p class="text-black">Médias</p>
                            </a>
                        </li>

                        <!-- Menu Commentaires -->
                        <li class="nav-item">
                            <a href="{{ route('admin.commentaires.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <p class="text-black">Commentaires</p>
                            </a>
                        </li>

                        <!-- Menu Configuration -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear-fill"></i>
                                <p class="text-black">
                                    Configuration du type
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.type_contenu.index')}}" class="nav-link">
                                        <i class="nav-icon bi bi-tags"></i>
                                        <p class="text-black">Types de Contenus</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.type_media.index')}}" class="nav-link">
                                        <i class="nav-icon bi bi-file-earmark-richtext"></i>
                                        <p class="text-black">Types de Médias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu Aide -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon bi bi-question-circle-fill"></i>
                                <p class="text-black">FAQ & Aide</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        @yield('title')
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Promouvoir la beauté du Pays</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy;2025&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">CULTURE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Ajout de Bootstrap Icons pour les flèches -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        /* Style pour les flèches des menus déroulants */
        .nav-sidebar .menu-is-opening > .nav-link > .bi-chevron-right,
        .nav-sidebar .menu-is-opening > .nav-link > .bi-chevron-down,
        .nav-sidebar .menu-open > .nav-link > .bi-chevron-right,
        .nav-sidebar .menu-open > .nav-link > .bi-chevron-down {
            transition: transform 0.2s ease-in-out;
        }
        
        .nav-sidebar .menu-is-opening > .nav-link > .bi-chevron-right,
        .nav-sidebar .menu-open > .nav-link > .bi-chevron-right {
            transform: rotate(90deg);
        }
        
        /* Animation pour l'ouverture/fermeture des sous-menus */
        .nav-treeview {
            display: none;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        .nav-sidebar .menu-open > .nav-treeview,
        .nav-sidebar .menu-is-opening > .nav-treeview {
            display: block;
            max-height: 1000px; /* Ajustez cette valeur selon vos besoins */
        }
        
        /* Style amélioré pour les menus déroulants */
        .nav-sidebar .nav-item.has-treeview > .nav-link {
            cursor: pointer;
        }
        
        .toggle-submenu {
            float: right;
            margin-left: 8px;
            transition: transform 0.2s;
            cursor: pointer;
        }
        
        .nav-sidebar .menu-open > .nav-link .toggle-submenu,
        .nav-sidebar .menu-is-opening > .nav-link .toggle-submenu {
            transform: rotate(90deg);
        }
        
        .nav-sidebar .nav-item.has-treeview.menu-open > .nav-link::after,
        .nav-sidebar .nav-item.has-treeview.menu-is-opening > .nav-link::after {
            transform: rotate(90deg);
        }
    </style>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    @stack('scripts')
    @stack('svg-icons')
    <!-- Script pour gérer les menus déroulants -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des clics sur les flèches des menus déroulants
            document.querySelectorAll('.nav-sidebar .has-treeview > .nav-link .toggle-submenu').forEach(arrow => {
                arrow.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const link = this.closest('.nav-link');
                    const parent = link.parentElement;
                    const wasOpen = parent.classList.contains('menu-open');
                    
                    // Fermer tous les autres menus ouverts
                    document.querySelectorAll('.nav-sidebar .has-treeview').forEach(item => {
                        if (item !== parent) {
                            item.classList.remove('menu-open');
                            const submenu = item.querySelector('.nav-treeview');
                            if (submenu) submenu.style.maxHeight = '0';
                        }
                    });
                    
                    // Basculer l'état du menu cliqué
                    if (!wasOpen) {
                        parent.classList.add('menu-open');
                        const submenu = link.nextElementSibling;
                        if (submenu && submenu.classList.contains('nav-treeview')) {
                            submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        }
                    } else {
                        parent.classList.remove('menu-open');
                        const submenu = link.nextElementSibling;
                        if (submenu && submenu.classList.contains('nav-treeview')) {
                            submenu.style.maxHeight = '0';
                        }
                    }
                });
            });
            
            // Initialiser les menus ouverts par défaut
            document.querySelectorAll('.nav-sidebar .has-treeview.menu-open').forEach(menu => {
                const submenu = menu.querySelector('.nav-treeview');
                if (submenu) {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                }
            });
        });
    </script>
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
