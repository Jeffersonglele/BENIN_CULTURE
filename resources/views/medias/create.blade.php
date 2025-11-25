@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter un Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('medias')}}">Medias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Formulaire d'ajout de média</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout de média -->
                <form action="{{ route('medias.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_contenu">Contenu</label>
                        <input type="text" class="form-control" id="id_contenu" name="id_contenu" required>
                    </div>
                    <div class="form-group">
                        <label for="id_type_contenu">Type de contenu</label>
                        <select name="id_type_contenu" id="id_type_contenu" class="form-control" required>
                            <option value="">Sélectionner un type de contenu</option>
                            @foreach($typeContenus as $typeContenu)
                                <option value="{{ $typeContenu->id }}">{{ $typeContenu->nom_type_contenu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="chemin">Chemin du fichier</label>
                        <input type="text" class="form-control" id="chemin" name="chemin" required>
                        <small class="form-text text-muted">Exemple: /uploads/images/mon-image.jpg</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description (optionnel)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection