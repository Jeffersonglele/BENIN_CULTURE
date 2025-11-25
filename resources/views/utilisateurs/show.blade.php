@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails de l'utilisateur</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('utilisateurs')}}">Utilisateurs</a></li>
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
                <h3 class="card-title">Informations de l'utilisateur</h3>
            </div>
            <div class="card-body">
                <p><strong>Nom :</strong> {{ $utilisateur->nom }}</p>
                <p><strong>Prénom :</strong> {{ $utilisateur->prenom }}</p>
                <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
                <p><strong>Role :</strong> {{ $utilisateur->role->nom_role }}</p>
                <p><strong>Statut :</strong> {{ $utilisateur->statut }}</p>
                <p><strong>Langue :</strong> {{ $utilisateur->langue->nom_langue }}</p>
                <p><strong>Photo :</strong> {{ $utilisateur->photo }}</p>
                <p><strong>Created At :</strong> {{ $utilisateur->created_at }}</p>
                <p><strong>Updated At :</strong> {{ $utilisateur->updated_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection