@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails du type de média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('type_media')}}">Type de Médias</a></li>
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
                <h3 class="card-title">Informations du type de média</h3>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nom du type de média :</strong> {{ $type_medias->nom_type_media }}</p>
                    <p class="text-muted mt-3">
                        <small>Créé le : {{ $type_medias->created_at->format('d/m/Y H:i') }}</small><br>
                        <small>Dernière mise à jour : {{ $type_medias->updated_at->format('d/m/Y H:i') }}</small>
                    </p>
                </div>
            </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('type_media') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection