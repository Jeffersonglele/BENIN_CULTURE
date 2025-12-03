@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails du Contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.contenus.index')}}">Contenus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Détails</li>
        </ol>
    </div>
</div>
@endsection

@section('page_content')
<div class="row">
    <div class="col-12">    
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Informations du Contenu</h3>
            </div>
            <div class="card-body">
                <p><strong>ID :</strong> {{ $contenu->id }}</p>
                <p><strong>Titre :</strong> {{ $contenu->titre }}</p>
                <p><strong>Statut :</strong> {{ $contenu->statut }}</p>
                <p><strong>Date de creation :</strong> {{ $contenu->date_creation }}</p>
                <p><strong>Region :</strong> {{ $contenu->region->nom_region ?? 'Non défini' }}</p>
                <p><strong>Langue :</strong> {{ $contenu->langue->nom_langue ?? 'Non défini' }}</p>
                <p><strong>Auteur :</strong> {{ $contenu->auteur->nom ?? 'Non défini' }} {{ $contenu->auteur->prenom ?? 'Non défini' }}</p>
                <p><strong>Type de Contenu :</strong> {{ $contenu->typeContenu->nom_type_contenu ?? 'Non défini' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection