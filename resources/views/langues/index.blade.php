@extends('layout')

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
        <h3 class="mb-0 animate-fade-in-left">Liste des Langues</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Langues</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title animate-fade-in-left">Liste des Langues</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="languesTable" class="table table-bordered table-striped display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th style="width: 120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($langues ?? [] as $langue)
                        <tr class="align-middle">
                            <td>{{ $langue->code_langue }}</td>
                            <td>{{ $langue->nom_langue }}</td>
                            <td>{{ Str::limit($langue->description, 50) }}</td>
                            <td>
                                <a href="{{ route('langues.show', $langue->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('langues.edit', $langue->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('langues.destroy', $langue->id) }}" 
                                          method="POST" 
                                          class="delete-form" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette langue ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger btn-action" 
                                                data-bs-toggle="tooltip" 
                                                title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucune langue trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-tools">
                    <a href="{{ route('langues.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus"></i> Ajouter une langue
                    </a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Vérifie si la table existe
        var table = document.getElementById('languesTable');
        if (table) {
            // Initialisation de DataTable avec des options de base
            var dataTable = $(table).DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
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
            console.error('La table avec l\'ID "languesTable" n\'a pas été trouvée');
        }
    });
</script>
@endpush