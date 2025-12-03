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
        margin: 25px 0;
    }
    /* Ajustement de l'alignement des boutons dans le tableau */
    .actions-cell {
        white-space: nowrap;
        padding: 10px 5px !important;
    }
    /* Meilleur espacement pour le formulaire de suppression */
    .delete-form {
        display: inline-block;
        margin: 0 5px !important;
    }
    /* Suppression de la marge du groupe de boutons */
    .btn-group {
        margin: 0 -5px;
    }
</style>
@endpush

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">
            </i>Liste des Types de Contenu</h3>  
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Type de Contenu</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="typecontenuTable" class="table table-bordered table-striped display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom du Type</th>
                            <th style="width: 120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($type_contenus as $type_contenu)
                        <tr>
                            <td>{{ $type_contenu->nom_type_contenu }}</td>
                            <td class="text-center actions-cell">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.type_contenu.show', $type_contenu->id) }}" 
                                       class="btn btn-sm btn-warning btn-action" 
                                       data-bs-toggle="tooltip" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.type_contenu.edit', $type_contenu->id) }}" 
                                       class="btn btn-sm btn-primary btn-action" 
                                       data-bs-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.type_contenu.destroy', $type_contenu->id) }}" 
                                          method="POST" 
                                          class="delete-form" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type de contenu ?');">
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
                        @endforeach
                    </tbody>
                </table>
                <div class="btn-add-container float-end">
                    <a href="{{ route('admin.type_contenu.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter un type de contenu
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
        var table = document.getElementById('typecontenuTable');
        if (table) {
            // Initialisation de DataTable avec des options de base
            var dataTable = $(table).DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
                    $('.dataTables_filter').addClass('float-end mb-3');
                    $('.dataTables_filter input')
                        .addClass('form-control form-control-sm')
                        .attr('placeholder', 'Rechercher...');
                    
                    // Personnalisation de la pagination
                    $('.dataTables_paginate').addClass('float-end');
                    
                    // Affiche un message de débogage dans la console
                    console.log('DataTable initialisée avec succès');
                }
            });
            
            // Vérifie si DataTable a été correctement initialisée
            if ($.fn.DataTable.isDataTable(table)) {
                console.log('La table est bien une DataTable');
            }
        } else {
            console.error('La table avec l\'ID "typecontenuTable" n\'a pas été trouvée');
        }
    });
</script>
@endpush