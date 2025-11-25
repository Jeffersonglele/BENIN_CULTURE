@extends('layout_langue')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier la Langue</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('langues')}}">Langues</a></li>
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
                <form action="{{ route('langues.update', $langue->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="code_langue" class="form-label">Code de la langue</label>
                        <input type="text" name="code_langue" id="code_langue" class="form-control" value="{{ $langue->code_langue }}">
                    </div>
                    <div class="mb-3">
                        <label for="nom_langue" class="form-label">Nom de la langue</label>
                        <input type="text" name="nom_langue" id="nom_langue" class="form-control" value="{{ $langue->nom_langue }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ $langue->description }}">
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection