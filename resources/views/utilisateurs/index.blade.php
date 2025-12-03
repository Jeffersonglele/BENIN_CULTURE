@extends('layout2')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3em 0.8em;
        margin-left: 2px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #0d6efd;
        color: white !important;
        border: 1px solid #0d6efd;
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.76563rem;
    }

    /* Styles pour les boutons d'action */
    .btn-action {
        margin: 0 8px;
    }
    .btn-action:first-child {
        margin-left: 0;
    }
    .btn-action:last-child {
        margin-right: 0;
    }
    /* Espacement du bouton Ajouter */
    .btn-add-container {
        margin: 20px 0;
    }
    /* Ajustement de l'alignement des boutons dans le tableau */
    .actions-cell {
        white-space: nowrap;
    }
    /* Meilleur espacement pour le formulaire de suppression */
    .delete-form {
        display: inline-block;
        margin: 0 3px;
    }
</style>
@endpush

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">
            </i>Liste des Utilisateurs</h3>  
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="utilisateursTable" class="table table-bordered table-striped display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>email</th>
                            <th>Rôles</th>
                            <th style="width: 120px">Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($utilisateurs as $utilisateur)
                        <tr>
                            <td>{{ $utilisateur->nom ?? 'N/A' }} {{ $utilisateur->prenom ?? '' }}</td>
                            <td>{{ $utilisateur->email ?? 'N/A' }}</td>
                            <td>
                                @if($utilisateur->role)
                                    {{ $utilisateur->role->nom_role }}
                                @else
                                    <span class="text-muted">Aucun rôle</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'bg-secondary';
                                    if (strtolower($utilisateur->statut) === 'actif') {
                                        $badgeClass = 'bg-success';
                                    } elseif (strtolower($utilisateur->statut) === 'en_attente' || strtolower($utilisateur->statut) === 'en attente') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif (strtolower($utilisateur->statut) === 'inactif') {
                                        $badgeClass = 'bg-danger';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $utilisateur->statut ?? 'inconnu')) }}
                                </span>
                            </td>
                            <td class="text-center actions-cell">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.utilisateurs.show', $utilisateur->id) }}" 
                                       class="btn btn-sm btn-warning btn-action" 
                                       data-bs-toggle="tooltip" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.utilisateurs.edit', $utilisateur->id) }}" 
                                       class="btn btn-sm btn-primary btn-action" 
                                       data-bs-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.utilisateurs.destroy', $utilisateur->id) }}" 
                                          method="POST" 
                                          class="delete-form" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger btn-action" 
                                                data-bs-toggle="tooltip" 
                                                title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucun utilisateur trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
                <div class="btn-add-container float-end">
                    <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Ajouter un Utilisateur
                    </a>
                </div>
            </div>
        </div>

        <!-- Afficher le SVG personnalisé 
                <div class="text-center mt-4">
                    <svg class="custom-svg-icon" style="width: 100px; height: auto; color: #007bff;">
                        <use xlink:href="#custom-logo"></use>
                    </svg>
                </div> -->

        <div class="mt-4">
            <i class="custom-logo-left" style="color: black;"></i>
        </div>
</div>
@endsection

@push('scripts')
<!-- DataTables & Plugins -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Vérifie si la table existe
        var table = document.getElementById('utilisateursTable');
        if (table) {
            // Configuration de DataTable
            var dataTable = $(table).DataTable({
                "processing": true,
                "serverSide": false, // Désactiver le traitement côté serveur car nous chargeons tout d'un coup
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "deferRender": true, // Important pour les grandes quantités de données
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json",
                    "search": "Rechercher :",
                    "lengthMenu": "Afficher _MENU_ entrées par page",
                    "zeroRecords": "Aucun enregistrement trouvé",
                    "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoEmpty": "Aucune entrée disponible",
                    "infoFiltered": "(filtré à partir de _MAX_ entrées totales)",
                    "paginate": {
                        "first": "Premier",
                        "last": "Dernier",
                        "next": "Suivant",
                        "previous": "Précédent"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                       '<"row"<"col-sm-12"tr>>' +
                       '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "initComplete": function() {
                    // Personnalisation du champ de recherche
                    var searchInput = $('.dataTables_filter input')
                        .addClass('form-control form-control-sm')
                        .attr('placeholder', 'Rechercher...');
                    
                    // Déplacer le champ de recherche dans un conteneur personnalisé si nécessaire
                    $('.dataTables_filter').addClass('float-end mb-3');
                    
                    // Personnalisation de la pagination
                    $('.dataTables_paginate').addClass('float-end');
                    
                    // Forcer le redessin du tableau
                    dataTable.columns.adjust().draw();
                    
                    console.log('DataTable initialisée avec succès');
                }
            });
            
            // Vérifie si DataTable a été correctement initialisée
            if ($.fn.DataTable.isDataTable(table)) {
                console.log('La table est bien une DataTable');
            }
        } else {
            console.error('La table avec l\'ID "utilisateursTable" n\'a pas été trouvée');
        }
    });
</script>
@endpush