@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier l'utilisateur</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.utilisateurs.index')}}">Utilisateurs</a></li>
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
                <h3 class="card-title">Modifier l'utilisateur</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.utilisateurs.update', $utilisateur->id)}}">
                    <div>
                        <label for="nom"  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" value="{{$utilisateur->nom}}">
                    </div>
                    <div>
                        <label for="prenom"  class="form-label">Prenom</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="{{$utilisateur->prenom}}">
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$utilisateur->email}}">
                    </div>
                    <div>
                        <label for="statut" class="form-label">Statut</label>
                        <input type="text" class="form-control" name="statut" id="statut" value="{{$utilisateur->statut}}">
                    </div>
                    <div>
                        <label for="date_naissance" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" name="date_naissance" id="date_naissance" value="{{$utilisateur->date_naissance}}">
                    </div>
                    <div>
                        <label for="date_inscription" class="form-label">Date d'inscription</label>
                        <input type="date"  class="form-control" name="date_inscription" id="date_inscription" value="{{$utilisateur->date_inscription}}">
                    </div>
                    <div>
                        <label for="mot_de_passe" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe">
                    </div>
                    <div>
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file"  class="form-control" name="photo" id="photo">
                    </div>
                    <div>
                        <label for="role" class="form-label">Role</label>
                        <select name="role" class="form-control" value="{{$utilisateur->role->id}}" id="role">
                            <option value="">Selectionner un role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nom_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="langue">Langue</label>
                        <select name="langue" class="form-control" value="{{$utilisateur->langue->id}}" id="langue">
                            <option value="">Selectionner une langue</option>
                            @foreach ($langues as $langue)
                                <option value="{{ $langue->id }}">{{ $langue->nom_langue }}</option>
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