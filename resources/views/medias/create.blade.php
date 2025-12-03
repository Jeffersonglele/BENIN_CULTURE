
@extends('layout2')

@section('page_title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 text-dark fw-bold">Ajouter un Média</h3>
        <p class="text-muted mb-0">Téléchargez et associez vos médias aux contenus</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}" class="text-decoration-none text-muted">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.medias.index')}}" class="text-decoration-none text-muted">Médias</a></li>
            <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Ajouter</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8">
        <div class="card border-0 shadow-lg overflow-hidden">
            <!-- En-tête avec dégradé -->
            <div class="card-header bg-gradient-primary text-white py-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-cloud-upload-alt fa-2x me-3"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="card-title mb-1 fw-bold">Formulaire d'ajout de média</h4>
                        <p class="card-text mb-0 opacity-75">Remplissez les informations pour télécharger votre média</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-5">
                <!-- Indicateur de progression -->
                <!--div class="progress-steps mb-5">
                    <div class="d-flex justify-content-between position-relative">
                        <div class="step completed text-center">
                            <div class="step-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2">
                                <i class="fas fa-pen"></i>
                            </div>
                            <span class="step-text d-block small fw-semibold">Informations</span>
                        </div>
                        <div class="progress-bar position-absolute top-0 start-0" style="height: 3px; width: 50%; background: #007bff; z-index: -1; margin-top: 12px;"></div>
                    </div>
                </div -->

                <!-- Formulaire principal -->
                <form id="media-form" action="{{ route('admin.medias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4">
                        <!-- Colonne gauche -->
                        <div class="col-md-6">
                            <!-- Contenu associé -->
                            <div class="form-group">
                                <label for="id_contenu" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-link me-2 text-primary"></i>Contenu associé
                                </label>
                                <select name="id_contenu" id="id_contenu" class="form-select form-select-lg shadow-sm border-0 rounded-3 py-3" required>
                                    <option value="" class="text-muted">Sélectionner un contenu</option>
                                    @forelse($contenus as $contenu)
                                        <option value="{{ $contenu->id }}" class="text-dark">{{ $contenu->titre }}</option>
                                    @empty
                                        <option value="" disabled>Aucun contenu disponible. Veuillez d'abord créer un contenu.</option>    
                                    @endforelse
                                </select>
                                <div class="form-text text-muted mt-1">
                                    <i class="fas fa-info-circle me-1"></i>Choisissez le contenu auquel associer ce média
                                </div>
                            </div>

                            <!-- Type de média -->
                            <div class="form-group mt-4">
                                <label for="id_type_contenu" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-tag me-2 text-primary"></i>Type de média
                                </label>
                                <select name="id_type_contenu" id="id_type_contenu" class="form-select form-select-lg shadow-sm border-0 rounded-3 py-3" required>
                                    <option value="" class="text-muted">Sélectionner un type de média</option>
                                    @foreach($typeContenus as $typeContenu)
                                        <option value="{{ $typeContenu->id }}" class="text-dark">{{ $typeContenu->nom_type_contenu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-md-6">
                            <!-- Upload de fichier -->
                            <div class="form-group">
                                <label class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-file-upload me-2 text-primary"></i>Fichier média
                                </label>
                                <div class="file-upload-area border-dashed rounded-3 p-4 text-center bg-light position-relative">
                                    <input type="file" class="file-input position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" 
                                           id="fichier" name="fichier" accept="image/*,video/*,audio/*" required>
                                    
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <h5 class="text-dark mb-2">Glissez-déposez votre fichier</h5>
                                        <p class="text-muted mb-3">ou cliquez pour parcourir</p>
                                        <div class="supported-formats">
                                            <span class="badge bg-primary me-1 mb-1">JPG</span>
                                            <span class="badge bg-primary me-1 mb-1">PNG</span>
                                            <span class="badge bg-primary me-1 mb-1">GIF</span>
                                            <span class="badge bg-success me-1 mb-1">MP4</span>
                                            <span class="badge bg-success me-1 mb-1">AVI</span>
                                            <span class="badge bg-warning me-1 mb-1">MP3</span>
                                            <span class="badge bg-warning me-1 mb-1">WAV</span>
                                        </div>
                                    </div>
                                    
                                    <div class="file-preview mt-3 d-none">
                                        <div class="alert alert-success d-flex align-items-center">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span class="file-name">Fichier sélectionné</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mt-4">
                        <label for="description" class="form-label fw-semibold text-dark mb-2">
                            <i class="fas fa-align-left me-2 text-primary"></i>Description (Obligatoire)
                        </label>
                        <textarea class="form-control border-0 shadow-sm rounded-3 py-3" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Décrivez brièvement votre média..." required></textarea>
                    </div>

                    

                    <!-- Bouton d'initiation du paiement -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold rounded-3 shadow">
                            <i class="fas fa-credit-card me-2"></i>
                            <span class="badge bg-white text-primary ms-2">Validation</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>             
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6b6b6eff 0%, #dcb131ff 100%) !important;
    }
    
    .file-upload-area {
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .file-upload-area:hover {
        border-color: #007bff;
        background: #e3f2fd;
    }
    
    .file-upload-area.dragover {
        border-color: #28a745;
        background: #d4edda;
    }
    
    .step-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .step.completed .step-icon {
        background: #28a745 !important;
    }
    
    .step.active .step-icon {
        background: #007bff !important;
        color: white !important;
        transform: scale(1.1);
    }
    
    .progress-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e9ecef;
        z-index: -2;
    }
    
    .form-control, .form-select {
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
        border-color: #007bff !important;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fichier');
    const fileUploadArea = document.querySelector('.file-upload-area');
    const uploadContent = document.querySelector('.upload-content');
    const filePreview = document.querySelector('.file-preview');
    const fileName = document.querySelector('.file-name');
    const initPaymentBtn = document.getElementById('init-payment');
    const paymentSection = document.getElementById('payment-section');

    // Gestion de l'upload de fichier
    fileInput.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const file = this.files[0];
            fileName.textContent = file.name;
            uploadContent.classList.add('d-none');
            filePreview.classList.remove('d-none');
        }
    });

    // Drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        fileUploadArea.classList.add('dragover');
    }

    function unhighlight() {
        fileUploadArea.classList.remove('dragover');
    }

    fileUploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            // Créer un objet DataTransfer pour l’input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(files[0]); // prends le premier fichier
            fileInput.files = dataTransfer.files;

            // Mise à jour de l'interface
            const file = files[0];
            fileName.textContent = file.name;
            uploadContent.classList.add('d-none');
            filePreview.classList.remove('d-none');
        }
    }

    

    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.querySelector('.card-body').insertBefore(alertDiv, document.getElementById('media-form'));
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>
@endpush