@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails du Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('author.medias.index')}}">Medias</a></li>
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
                <h3 class="card-title">Informations du Média</h3>
            </div>
            <div class="card-body">
                <p><strong>Contenu :</strong> {{ $media->contenu->titre }}</p>
                <p><strong>Type de Contenu :</strong> {{ $media->typeContenu->nom_type_contenu }}</p>
                <p><strong>Description :</strong> {{ $media->description }}</p>
                <p><strong>Chemin Accès :</strong> {{ $media->chemin }}</p>
                <p><strong>Type :</strong> {{ $media->type }}</p>
                <p class="text-muted mt-3">
                    <small>Créé le : {{ $media->created_at->format('d/m/Y H:i') }}</small><br>
                    <small>Dernière mise à jour : {{ $media->updated_at->format('d/m/Y H:i') }}</small>
                </p>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('author.medias.index') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection