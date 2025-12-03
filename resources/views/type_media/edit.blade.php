@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier le type de Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.type_media.index')}}">Type de Médias</a></li>
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
                <h3 class="card-title">Modifier le type de média</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.type_media.update', $type_media->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nom_type_media" class="form-label">Nom du type de média</label>
                        <input type="text" class="form-control" id="nom_type_media" name="nom_type_media" value="{{ $type_media->nom_type_media }}">
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection