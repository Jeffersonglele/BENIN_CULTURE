@extends('layout')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier le Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('medias')}}">Medias</a></li>
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
                <form action="{{ route('medias.update', $media->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_contenu" class="form-label">Contenu</label>
                        <input type="text" name="id_contenu" id="id_contenu" class="form-control" value="{{ $media->contenu->titre }}">
                    </div>
                    <div class="mb-3">
                        <label for="id_type_contenu" class="form-label">Type de contenu</label>
                        <select name="id_type_contenu" id="id_type_contenu" class="form-control" required>
                            @foreach($typeContenus as $type)
                                <option value="{{ $type->id }}" {{ $media->id_type_contenu == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom_type_contenu }}
                                </option>
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