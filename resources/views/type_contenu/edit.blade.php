@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier le Type de Contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('type_contenu')}}">Type de Contenu</a></li>
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
                <h3 class="card-title">Modifier le Type de Contenu</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('type_contenu.update', $type_contenu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nom_type_contenu" class="form-label">Nom du type de contenu</label>
                        <input type="text" class="form-control" id="nom_type_contenu" name="nom_type_contenu" value="{{ $type_contenu->nom_type_contenu }}">
                    </div>
                    <a href="{{ route('type_contenu') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-success" style="position: absolute; right: 10px;">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection