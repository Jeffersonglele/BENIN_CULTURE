@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier la Région</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.regions.index')}}">Régions</a></li>
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
                <h3 class="card-title">Modifier la Langue</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.regions.update', $region->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nom_region" class="form-label">Nom de la région</label>
                        <input type="text" class="form-control" id="nom_region" name="nom_region" value="{{ $region->nom_region }}">
                    </div>
                    <div class="mb-3">
                        <label for="population" class="form-label">Population</label>
                        <input type="number" class="form-control" id="population" name="population" value="{{ $region->population }}">
                    </div>
                    <div class="mb-3">
                        <label for="superficie" class="form-label">Superficie</label>
                        <input type="number" class="form-control" id="superficie" name="superficie" value="{{ $region->superficie }}">
                    </div>
                    <div class="mb-3">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input type="text" class="form-control" id="localisation" name="localisation" value="{{ $region->localisation }}">
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection