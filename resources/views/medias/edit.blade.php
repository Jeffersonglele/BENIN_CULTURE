@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Modifier le Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.medias.index')}}">Medias</a></li>
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
                <form action="{{ route('admin.medias.update', $media->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $media->description }}">
                        </div>
                        <div class="mb-3">
                            <label for="chemin" class="form-label">Media</label>
                            <input type="file" 
                                name="chemin" 
                                id="chemin" 
                                class="form-control"
                                accept="image/*,video/*">
                            @if($media->chemin)
                                <div class="mt-2">
                                    <small>Fichier actuel : {{ basename($media->chemin) }}</small><br>
                                    @if(str_starts_with($media->type, 'image'))
                                        <img src="{{ asset($media->chemin) }}" alt="Prévisualisation" style="max-width: 200px; margin-top: 10px;">
                                    @elseif(str_starts_with($media->type, 'video'))
                                        <video width="320" height="240" controls style="margin-top: 10px;">
                                            <source src="{{ asset($media->chemin) }}" type="video/{{ pathinfo($media->chemin, PATHINFO_EXTENSION) }}">
                                            Votre navigateur ne supporte pas la lecture de vidéos.
                                        </video>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection