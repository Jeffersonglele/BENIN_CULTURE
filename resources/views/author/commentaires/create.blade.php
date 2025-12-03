@extends('layout_langue')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter une Langue</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('langues')}}">Langues</a></li>
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
                <h3 class="card-title">Formulaire d'ajout de langue</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout de langue -->
                <form action="{{ route('langues.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="code_langue">Code de la langue</label>
                        <input type="text" class="form-control" id="code_langue" name="code_langue" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_langue">Nom de la langue</label>
                        <input type="text" class="form-control" id="nom_langue" name="nom_langue" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection