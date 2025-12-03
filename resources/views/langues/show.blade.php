@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails de la Langue</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.langues.index')}}">Langues</a></li>
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
                <h3 class="card-title">Informations de la Langue</h3>
            </div>
            <div class="card-body">
                 <p><strong>Code de la langue :</strong> {{ $langue->code_langue }}</p>
                 <p><strong>Nom de la langue :</strong> {{ $langue->nom_langue }}</p>
                 <p><strong>Description :</strong>{{ $langue->description }}</p>
                 <p><strong>Créé le :</strong> {{ $langue->created_at->format('d/m/Y H:i') }}</p>
                 <p><strong>Mis à jour le :</strong> {{ $langue->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection