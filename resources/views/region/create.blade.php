@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter une Région</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.regions.index')}}">Régions</a></li>
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
                <h3 class="card-title">Formulaire d'ajout de région</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout de région -->
                <form action="{{ route('admin.regions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom_region">Nom de la région</label>
                        <input type="text" class="form-control" id="nom_region" name="nom_region" required>
                    </div>
                    <div class="form-group">
                        <label for="population">Population</label>
                        <input type="text" class="form-control" id="population" name="population" required>
                    </div>
                    <div class="form-group">
                        <label for="superficie">Superficie</label>
                        <input type="text" class="form-control" id="superficie" name="superficie" required>
                    </div>
                    <div class="form-group">
                        <label for="localisation">Localisation</label>
                        <input type="text" class="form-control" id="localisation" name="localisation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection