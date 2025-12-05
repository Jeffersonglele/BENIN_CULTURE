@extends('layout')

@section('page_title')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-0 text-dark fw-bold">Ajouter un média</h1>
        <p class="text-muted mb-0">Téléversez vos fichiers en quelques clics</p>
    </div>
    <a href="{{ route('author.medias.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>
@endsection

@section('page_content')
<div class="full-width-form">
    <!-- Zone de drag & drop principale -->
    <div class="drag-drop-section mb-4">
        <div class="drop-zone" id="dropZone">
            <input type="file" id="fileInput" name="fichier" class="d-none" accept="image/*,video/*,audio/*,.pdf,.doc,.docx">
            
            <div class="drop-content" id="dropContent">
                <div class="drop-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h4 class="drop-title">Déposez votre fichier ici</h4>
                <p class="drop-subtitle">ou cliquez pour parcourir</p>
                <div class="formats-info">
                    <span class="badge">Images</span>
                    <span class="badge">Vidéos</span>
                    <span class="badge">Audio</span>
                    <span class="badge">Documents</span>
                </div>
                <p class="drop-size">Max. 50MB</p>
            </div>
            
            <div class="file-preview d-none" id="filePreview">
                <div class="preview-header">
                    <div class="file-info">
                        <i class="fas fa-file-alt text-primary"></i>
                        <div class="ms-3">
                            <h5 class="file-name mb-1"></h5>
                            <p class="file-details mb-0">
                                <span class="file-size me-3"></span>
                                <span class="file-type"></span>
                            </p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="image-preview mt-3 d-none" id="imagePreview">
                    <img src="" alt="Preview" class="img-fluid rounded">
                </div>
            </div>
        </div>
        <div class="error-message text-danger small mt-2 d-none" id="errorMessage"></div>
    </div>

    <div class="form-container">
        <form action="{{ route('author.medias.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            
            <div class="row g-4">
                <!-- Colonne gauche - Informations -->
                <div class="col-lg-8">
                    <div class="card border-0 bg-white shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                Informations du média
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Contenu associé *</label>
                                        <select name="id_contenu" class="form-select" required>
                                            <option value="">Sélectionnez un contenu</option>
                                            @foreach($contenus as $contenu)
                                                <option value="{{ $contenu->id }}">{{ $contenu->titre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Type de média *</label>
                                        <select name="id_type_contenu" class="form-select" required>
                                            <option value="">Sélectionnez un type</option>
                                            @foreach($typeContenus as $type)
                                                <option value="{{ $type->id }}">{{ $type->nom_type_contenu }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-0">
                                        <label class="form-label fw-semibold">Description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Description optionnelle..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne droite - Actions -->
                <div class="col-lg-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-cog me-2 text-primary"></i>
                                Actions
                            </h5>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="button" id="btn-pay" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>Procéder au paiement
                                </button>
                                <div id="fedapay-form-container" class="mt-3"></div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="upload-info">
                                <h6 class="fw-semibold mb-3">Informations :</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <small>Transfert sécurisé</small>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <small>Support multi-formats</small>
                                    </li>
                                    <li>
                                        <i class="fas fa-check text-success me-2"></i>
                                        <small>Traitement immédiat</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Conteneur pleine largeur */
.full-width-form {
    width: 100%;
    margin: 0;
    padding: 0;
}

/* Zone de drag & drop pleine largeur */
.drag-drop-section {
    width: 100%;
}

.drop-zone {
    width: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 3px dashed #dee2e6;
    border-radius: 12px;
    padding: 4rem 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    min-height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.drop-zone:hover {
    border-color: #007bff;
    background: linear-gradient(135deg, #e7f1ff 0%, #d4e6ff 100%);
    transform: translateY(-2px);
}

.drop-zone.dragover {
    border-color: #28a745;
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.2); }
    70% { box-shadow: 0 0 0 15px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
}

.drop-icon {
    font-size: 4rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
    transition: transform 0.3s ease;
}

.drop-zone:hover .drop-icon {
    transform: scale(1.1);
    color: #007bff;
}

.drop-title {
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.5rem;
}

.drop-subtitle {
    color: #6c757d;
    margin-bottom: 1.5rem;
}

.formats-info {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.formats-info .badge {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 20px;
}

.drop-size {
    color: #6c757d;
    font-size: 0.875rem;
}

/* Prévisualisation de fichier */
.file-preview {
    width: 100%;
    text-align: left;
}

.preview-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
}

.file-info {
    display: flex;
    align-items: center;
}

.file-info i {
    font-size: 2.5rem;
}

.file-name {
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.25rem;
}

.file-details {
    color: #6c757d;
    font-size: 0.875rem;
}

.image-preview img {
    max-height: 200px;
    width: auto;
    border: 1px solid #dee2e6;
}

/* Conteneur du formulaire */
.form-container {
    margin-top: 2rem;
}

/* Cartes */
.card {
    border-radius: 12px;
    overflow: hidden;
}

.card-title {
    color: #212529;
    font-weight: 600;
}

/* Boutons */
.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    padding: 1rem 2rem;
    font-weight: 600;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

/* Champs de formulaire */
.form-select, .form-control {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-select:focus, .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .drop-zone {
        padding: 3rem 1rem;
        min-height: 200px;
    }
    
    .drop-icon {
        font-size: 3rem;
    }
    
    .drop-title {
        font-size: 1.25rem;
    }
    
    .preview-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-primary {
        padding: 0.75rem 1rem;
    }
}

/* Animation de chargement */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.file-preview {
    animation: fadeIn 0.3s ease-out;
}

/* Message d'erreur */
.error-message {
    background: #f8d7da;
    color: #721c24;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    border-left: 4px solid #dc3545;
}
</style>
@endpush

<!-- Formulaire de paiement FedaPay -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-lock me-2"></i>Paiement sécurisé
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="paymentStatus" class="text-center mb-3">
                    <div class="spinner-border text-primary mb-3" role="status" id="paymentSpinner">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mb-0">Initialisation du paiement en cours...</p>
                </div>
                
                <div id="fedapay-button-container" class="text-center mt-4">
                    <!-- Le bouton de paiement sera inséré ici par FedaPay -->
                </div>
                
                <div class="alert alert-info mt-4 mb-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <small class="d-block">Paiement sécurisé par FedaPay</small>
                            <small class="d-block">Vos informations de paiement sont cryptées</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Annuler
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('btn-pay');

    payButton.addEventListener('click', async function () {
        payButton.disabled = true;
        payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Chargement...';

        try {
            const response = await fetch('/author/medias/init-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            if (!data.success) {
                alert(data.message || 'Erreur lors de la création du paiement.');
                payButton.disabled = false;
                payButton.innerHTML = '<i class="fas fa-credit-card me-2"></i>Procéder au paiement';
                return;
            }

            openFedaPayCheckout(data.token, data.public_key, data.mode);

        } catch (err) {
            console.error(err);
            alert('Une erreur est survenue. Veuillez réessayer.');
            payButton.disabled = false;
            payButton.innerHTML = '<i class="fas fa-credit-card me-2"></i>Procéder au paiement';
        }
    });

    function openFedaPayCheckout(token, publicKey, mode) {
        FedaPay.init({
            public_key: publicKey,
            mode: mode,
            token: token,
            container: 'fedapay-button-container',
            onComplete: function (result) {
                console.log('Paiement terminé : ', result);

                if (result.status === 'approved') {
                    document.getElementById('uploadForm').submit();
                }
            }
        });
    }
});


    
    // Fonction pour gérer le processus de paiement
    async function processPayment(amount, description) {
        const payButton = document.getElementById('btn-pay');
        
        try {
            // Afficher le chargement
            payButton.disabled = true;
            payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Chargement...';
            
            // Appeler l'API d'initialisation du paiement
            const response = await fetch('{{ route("author.medias.init-payment") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    amount: amount,
                    description: description
                })
            });
            
            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.message || 'Erreur lors de l\'initialisation du paiement');
            }
            
            // Afficher le formulaire FedaPay
            const container = document.getElementById('fedapay-form-container');
            container.innerHTML = ''; // Nettoyer le conteneur
            
            // Créer le bouton de paiement FedaPay
            FedaPay.checkout({
                public_key: data.public_key,
                transaction: {
                    amount: amount,
                    description: description,
                    callback: function(result) {
                        if (result.status === 'approved') {
                            // Si le paiement est approuvé, soumettre le formulaire
                            document.getElementById('uploadForm').submit();
                        } else {
                            // Réactiver le bouton en cas d'erreur
                            payButton.disabled = false;
                            payButton.innerHTML = 'Payer et publier';
                            showError('Le paiement a échoué. Veuillez réessayer.');
                        }
                    }
                },
                // Ajouter des métadonnées utiles
                meta: {
                    user_id: '{{ auth("utilisateur")->id() }}',
                    source: 'media_upload'
                }
            });
            
        } catch (error) {
            console.error('Erreur lors du paiement:', error);
            showError(error.message || 'Une erreur est survenue lors du traitement du paiement');
            payButton.disabled = false;
            payButton.innerHTML = 'Payer et publier';
        }
    }
    
    // Gérer la soumission du formulaire
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Vérifier si un fichier est sélectionné
        if (!fileInput.files.length) {
            showError('Veuillez sélectionner un fichier');
            dropZone.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        
        // Vérifier que les champs requis sont remplis
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            showError('Veuillez remplir tous les champs obligatoires');
            return false;
        }
    });
    
    // Gérer la validation des champs en temps réel
    document.querySelectorAll('#uploadForm [required]').forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

document.addEventListener('DOMContentLoaded', function() {
    // Éléments
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const dropContent = document.getElementById('dropContent');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.querySelector('.file-name');
    const fileSize = document.querySelector('.file-size');
    const fileType = document.querySelector('.file-type');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewImg = imagePreview.querySelector('img');
    const removeBtn = document.getElementById('removeFile');
    const errorMessage = document.getElementById('errorMessage');
    const uploadForm = document.getElementById('uploadForm');
    
    const MAX_SIZE = 50 * 1024 * 1024; // 50MB
    
    // Formater la taille
    function formatSize(bytes) {
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        if (bytes === 0) return '0 Bytes';
        const i = Math.floor(Math.log(bytes) / Math.log(1024));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Afficher erreur
    function showError(text) {
        errorMessage.textContent = text;
        errorMessage.classList.remove('d-none');
        setTimeout(() => errorMessage.classList.add('d-none'), 5000);
    }
    
    // Gérer le fichier
    function handleFile(file) {
        // Validation taille
        if (file.size > MAX_SIZE) {
            showError(`Fichier trop volumineux (${formatSize(MAX_SIZE)} max)`);
            return;
        }
        
        // Validation type
        const validTypes = ['image/', 'video/', 'audio/', 'application/pdf', 
                           'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!validTypes.some(type => file.type.startsWith(type))) {
            showError('Type de fichier non supporté');
            return;
        }
        
        // Mettre à jour l'affichage
        fileName.textContent = file.name;
        fileSize.textContent = formatSize(file.size);
        fileType.textContent = file.type.split('/')[0] || 'Document';
        
        // Prévisualiser les images
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreviewImg.src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
        }
        
        // Afficher la prévisualisation
        dropContent.classList.add('d-none');
        filePreview.classList.remove('d-none');
        dropZone.style.padding = '2rem';
        dropZone.style.minHeight = 'auto';
    }
    
    // Événements drag & drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
        dropZone.addEventListener(event, (e) => {
            e.preventDefault();
            e.stopPropagation();
        });
    });
    
    ['dragenter', 'dragover'].forEach(event => {
        dropZone.addEventListener(event, () => {
            dropZone.classList.add('dragover');
        });
    });
    
    ['dragleave', 'drop'].forEach(event => {
        dropZone.addEventListener(event, () => {
            dropZone.classList.remove('dragover');
        });
    });
    
    dropZone.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files[0];
        if (file) {
            handleFile(file);
            fileInput.files = e.dataTransfer.files;
        }
    });
    
    // Cliquer sur la zone
    dropZone.addEventListener('click', () => {
        fileInput.click();
    });
    
    // Changer de fichier via input
    fileInput.addEventListener('change', (e) => {
        if (e.target.files[0]) {
            handleFile(e.target.files[0]);
        }
    });
    
    // Supprimer le fichier
    removeBtn.addEventListener('click', () => {
        fileInput.value = '';
        dropContent.classList.remove('d-none');
        filePreview.classList.add('d-none');
        imagePreview.classList.add('d-none');
        dropZone.style.padding = '4rem 2rem';
        dropZone.style.minHeight = '250px';
    });
    
    // Validation du formulaire
    uploadForm.addEventListener('submit', (e) => {
        if (!fileInput.files.length) {
            e.preventDefault();
            showError('Veuillez sélectionner un fichier');
            dropZone.scrollIntoView({ behavior: 'smooth', block: 'center' });
            dropZone.classList.add('dragover');
            setTimeout(() => dropZone.classList.remove('dragover'), 1000);
            return;
        }
        
        const contentSelect = uploadForm.querySelector('[name="id_contenu"]');
        const typeSelect = uploadForm.querySelector('[name="id_type_contenu"]');
        
        if (!contentSelect.value) {
            e.preventDefault();
            showError('Veuillez sélectionner un contenu associé');
            contentSelect.focus();
            return;
        }
        
        if (!typeSelect.value) {
            e.preventDefault();
            showError('Veuillez sélectionner un type de média');
            typeSelect.focus();
            return;
        }
    });
    
    // Réinitialisation
    uploadForm.addEventListener('reset', () => {
        fileInput.value = '';
        dropContent.classList.remove('d-none');
        filePreview.classList.add('d-none');
        imagePreview.classList.add('d-none');
        errorMessage.classList.add('d-none');
        dropZone.style.padding = '4rem 2rem';
        dropZone.style.minHeight = '250px';
        dropZone.classList.remove('dragover');
    });
});
</script>
@endpush