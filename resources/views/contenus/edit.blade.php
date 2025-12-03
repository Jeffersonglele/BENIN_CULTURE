@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier le Contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('contenus')}}">Contenus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Modifier le Contenu</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('contenus.update', $contenu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ $contenu->titre }}">
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <input type="text" class="form-control" id="statut" name="statut" value="{{ $contenu->statut }}">
                    </div>
                    <div class="form-group">
                        <label for="date_creation">Date de creation</label>
                        <input type="date" class="form-control" id="date_creation" name="date_creation" value="{{ $contenu->date_creation }}">
                    </div>
                    <div class="form-group">
                        <label for="region_id">Region</label>
                        <select class="form-control" id="id_region" name="id_region">
                            <option value="">Selectionner une region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ $region->id == $contenu->id_region ? 'selected' : '' }}>{{ $region->nom_region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="langue_id">Langue</label>
                        <select class="form-control" id="id_langue" name="id_langue">
                            <option value="">Selectionner une langue</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id }}" {{ $langue->id == $contenu->id_langue ? 'selected' : '' }}>{{ $langue->nom_langue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="auteur_id">Auteur</label>
                        <select class="form-control" id="id_auteur" name="id_auteur">
                            <option value="">Selectionner un auteur</option>
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->id }}" {{ $auteur->id == $contenu->id_auteur ? 'selected' : '' }}>{{ $auteur->nom }} {{ $auteur->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type_contenu_id">Type de contenu</label>
                        <select class="form-control" id="id_type_contenu" name="id_type_contenu">
                            <option value="">Selectionner un type de contenu</option>
                            @foreach($type_contenus as $type_contenu)
                                <option value="{{ $type_contenu->id }}" {{ $type_contenu->id == $contenu->id_type_contenu ? 'selected' : '' }}>{{ $type_contenu->nom_type_contenu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection