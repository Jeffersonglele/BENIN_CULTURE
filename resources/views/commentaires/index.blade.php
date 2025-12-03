@extends('layout2')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<!-- Icons Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    .comment-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .comment-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .comment-header {
        background: #E2E9C0 !important;
        border-radius: 12px 12px 0 0 !important;
        padding: 15px 20px;
    }
    
    .comment-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #feca57 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
        font-size: 18px;
    }
    
    .comment-user-info h6 {
        margin: 0;
        font-weight: 600;
    }
    
    .comment-user-info small {
        opacity: 0.9;
        font-size: 0.85em;
    }
    
    .comment-content {
        padding: 20px;
        background: #f8f9fa !important;
        border-radius: 0 0 12px 12px;
    }
    
    .comment-text {
        line-height: 1.6;
        color: #495057;
        margin-bottom: 15px;
    }
    
    .comment-meta {
        border-top: 1px solid #e9ecef;
        padding-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .comment-date {
        color: #6c757d;
        font-size: 0.85em;
    }
    
    .comment-actions .btn {
        margin-left: 8px;
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.8em;
    }
    
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75em;
        font-weight: 500;
    }
    
    .badge-published {
        background: #d4edda;
        color: #155724;
    }
    
    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .badge-rejected {
        background: #f8d7da;
        color: #721c24;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .view-toggle {
        margin-bottom: 20px;
    }
    
    .view-toggle .btn {
        border-radius: 20px;
        margin-left: 10px;
    }
</style>
@endpush

@section('page_title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">
            <i class="bi bi-chat-left-text me-2"></i>Gestion des Commentaires
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Commentaires</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <!-- Contrôles de vue -->
        <div class="view-toggle text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" id="cardViewBtn">
                    <i class="bi bi-grid"></i> Vue Cartes
                </button>
                <button type="button" class="btn btn-outline-primary" id="tableViewBtn">
                    <i class="bi bi-list"></i> Vue Tableau
                </button>
            </div>
        </div>

        <!-- Vue Cartes (par défaut) -->
        <div id="cardView">
            @if($commentaires->count() > 0)
                <div class="row">
                    @foreach($commentaires as $commentaire)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card comment-card">
                            <div class="card-header comment-header">
                                <div class="d-flex align-items-center">
                                    @if($commentaire->utilisateur)
                                        <div class="comment-avatar me-3">
                                            {{ substr($commentaire->utilisateur->prenom, 0, 1) }}{{ substr($commentaire->utilisateur->nom, 0, 1) }}
                                        </div>
                                        <div class="comment-user-info">
                                            <h6>{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</h6>
                                            <small>{{ $commentaire->utilisateur->email }}</small>
                                        </div>
                                    @else
                                        <div class="comment-avatar me-3 bg-secondary">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="comment-user-info">
                                            <h6>Utilisateur inconnu</h6>
                                            <small>Non disponible</small>
                                        </div>
                                    @endif
                                    <div class="ms-auto">
                                        <span class="badge badge-status badge-{{ $commentaire->statut }}">
                                            {{ ucfirst($commentaire->statut) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body comment-content">
                                <div class="comment-text">
                                    {{ Str::limit($commentaire->texte ?? '', 200) }}
                                    @if(isset($commentaire->texte) && strlen($commentaire->texte) > 150)
                                        <a href="#" class="text-primary read-more" data-comment-id="{{ $commentaire->id }}">Lire la suite</a>
                                    @endif
                                </div>
                                <div class="comment-meta">
                                    <div class="comment-date">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $commentaire->created_at->format('d/m/Y à H:i') }}
                                    </div>
                                    <div class="comment-actions">
                                        <a href="{{ route('admin.commentaires.show', $commentaire->id) }}" 
                                           class="btn btn-outline-info btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Voir les détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.commentaires.edit', $commentaire->id) }}" 
                                           class="btn btn-outline-warning btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}" 
                                              method="POST" 
                                              class="d-inline delete-form" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-chat-left-text"></i>
                    <h4>Aucun commentaire trouvé</h4>
                    <p class="mb-4">Il n'y a aucun commentaire à afficher pour le moment.</p>
                    <a href="{{ route('admin.commentaires.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter un commentaire
                    </a>
                </div>
            @endif
        </div>

        <!-- Vue Tableau (cachée par défaut) -->
        <div id="tableView" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <table id="commentairesTable" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Auteur</th>
                                <th>Commentaire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commentaires as $commentaire)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="comment-avatar me-2" style="width: 35px; height: 35px; font-size: 14px;">
                                            {{ substr($commentaire->utilisateur->prenom, 0, 1) }}{{ substr($commentaire->utilisateur->nom, 0, 1) }}
                                        </div>
                                        <div>
                                            <strong>{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $commentaire->utilisateur->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="comment-preview">
                                        {{ Str::limit($commentaire->texte ?? '', 80) }}
                                        @if(strlen($commentaire->texte ?? '') > 80)
                                            <a href="#" class="text-primary read-more" data-comment-id="{{ $commentaire->id }}">Lire la suite</a>
                                        @endif
                                    </div>
                                </td>
                                <td> 
                                    <small>{{ $commentaire->created_at->format('d/m/Y') }}</small>
                                    <br>
                                    <small class="text-muted">{{ $commentaire->created_at->format('H:i') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bouton Ajouter >
        @if($commentaires->count() > 0)
        <div class="text-center mt-4">
            <a href="{{ route('admin.commentaires.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i> Ajouter un commentaire
            </a>
        </div -->
        @endif
    </div>
</div>

<!-- Modal pour lire la suite -->
<div class="modal fade" id="commentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Commentaire complet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="commentFullContent">
                <!-- Le contenu complet sera chargé ici -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables & Plugins -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialisation du DataTable pour la vue tableau
        var table = $('#commentairesTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
            },
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[2, 'desc']], // Tri par date décroissante
            "columnDefs": [
                { "orderable": false, "targets": [2] } // Désactive le tri sur la colonne Actions
            ]
        });

        // Gestion du toggle de vue
        $('#cardViewBtn').on('click', function() {
            $('#cardView').show();
            $('#tableView').hide();
            $(this).addClass('active');
            $('#tableViewBtn').removeClass('active');
        });

        $('#tableViewBtn').on('click', function() {
            $('#cardView').hide();
            $('#tableView').show();
            $(this).addClass('active');
            $('#cardViewBtn').removeClass('active');
        });

        // Gestion du "Lire la suite"
        $('.read-more').on('click', function(e) {
            e.preventDefault();
            var card = $(this).closest('.comment-card');
            var titre = card.find('.comment-title').text();
            var texte = card.find('.comment-text-full').text();
            
            $('#commentModal .modal-title').text(titre);
            $('#commentFullContent').html(`
                <p>${texte}</p>
                <div class="mt-3 text-muted">
                    <small>Posté le ${card.find('.comment-date').text()}</small>
                </div>
            `);
            $('#commentModal').modal('show');
        });

        // Initialisation des tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush