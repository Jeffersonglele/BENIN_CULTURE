@extends('layout2')

@section('page_title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Ajouter un Type de Média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin.culture')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.type_media.index')}}">Type de Médias</a></li>
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
                <h3 class="card-title">Formulaire d'ajout de type de média</h3>
            </div>
            <div class="card-body">
                <!-- Formulaire d'ajout de type de média -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.type_media.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nom_type_media">Nom du type de média</label>
                        <input type="text" class="form-control @error('nom_type_media') is-invalid @enderror" 
                               id="nom_type_media" name="nom_type_media" 
                               value="{{ old('nom_type_media') }}" 
                               required maxlength="10">
                        @error('nom_type_media')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.type_media.index') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter le type de média</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection