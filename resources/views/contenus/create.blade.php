@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter un Contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('contenus')}}">Contenus</a></li>
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
                <h3 class="card-title">Formulaire d'ajout de contenu</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout de contenu -->
                <form action="{{ route('contenus.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <input type="text" class="form-control" id="statut" name="statut" required>
                    </div>
                    <div class="form-group">
                        <label for="date_creation">Date de creation</label>
                        <input type="date" class="form-control" id="date_creation" name="date_creation" required>
                    </div>
                    <div class="form-group">
                        <label for="region_id">Region</label>
                        <select class="form-control" id="region_id" name="region_id" required>
                            <option value="">Selectionner une region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->nom_region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="langue_id">Langue</label>
                        <select class="form-control" id="langue_id" name="langue_id" required>
                            <option value="">Selectionner une langue</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id }}">{{ $langue->nom_langue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="auteur_id">Auteur</label>
                        <select class="form-control" id="auteur_id" name="auteur_id" required>
                            <option value="">Selectionner un auteur</option>
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->id }}">{{ $auteur->nom }} {{ $auteur->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type_contenu_id">Type de contenu</label>
                        <select class="form-control" id="type_contenu_id" name="type_contenu_id" required>
                            <option value="">Selectionner un type de contenu</option>
                            @foreach($type_contenus as $type_contenu)
                                <option value="{{ $type_contenu->id }}">{{ $type_contenu->nom_type_contenu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection