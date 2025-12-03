@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter un Utilisateur</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.utilisateurs.index')}}">Utilisateurs</a></li>
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
                <h3 class="card-title">Formulaire d'ajout d'utilisateur</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout d'utilisateur -->
                <form action="{{ route('admin.utilisateurs.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mot_de_passe">Mot de passe</label>
                        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de naissance</label>
                        <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <input type="text" class="form-control" id="statut" name="statut" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" required>
                    </div>
                    <div class="form-group">
                        <label for="id_role">Role</label>
                        <select class="form-control" id="id_role" name="id_role" required>
                            <option value="">Selectionner un role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nom_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_langue">Langue</label>
                        <select class="form-control" id="id_langue" name="id_langue" required>
                            <option value="">Selectionner une langue</option>
                            @foreach ($langues as $langue)
                                <option value="{{ $langue->id }}">{{ $langue->nom_langue }}</option>
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