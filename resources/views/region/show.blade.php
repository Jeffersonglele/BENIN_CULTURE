@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails de la Région</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.regions.index')}}">Régions</a></li>
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
                <h3 class="card-title">Informations de la Région</h3>
            </div>
            <div class="card-body">
                <p><strong>ID :</strong> {{ $region->id }}</p>
                <p><strong>Nom :</strong> {{ $region->nom_region }}</p>
                <p><strong>Population :</strong> {{ $region->population }}</p>
                <p><strong>Superficie :</strong> {{ $region->superficie }} km²</p>
                <p><strong>Localisation :</strong> {{ $region->localisation }}</p>
            </div>
        </div>
    </div>
</div>
@endsection