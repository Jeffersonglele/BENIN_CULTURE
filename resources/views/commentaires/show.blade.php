@extends('layout_langue')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Détails de la Langue</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('langues.index')}}">Langues</a></li>
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
                <p><strong>ID :</strong> {{ $id }}</p>
                <!-- Ajoutez ici les détails de la langue -->
            </div>
        </div>
    </div>
</div>
@endsection