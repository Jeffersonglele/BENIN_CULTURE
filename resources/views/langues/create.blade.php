@extends('layout')

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

                <form action="{{ route('langues.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="code_langue">Code de la langue (2-5 caractères)</label>
                        <input type="text" class="form-control @error('code_langue') is-invalid @enderror" 
                               id="code_langue" name="code_langue" 
                               value="{{ old('code_langue') }}" 
                               required maxlength="5">
                        @error('code_langue')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nom_langue">Nom de la langue (max 10 caractères)</label>
                        <input type="text" class="form-control @error('nom_langue') is-invalid @enderror" 
                               id="nom_langue" name="nom_langue" 
                               value="{{ old('nom_langue') }}" 
                               required maxlength="10">
                        @error('nom_langue')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">Description (optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" 
                                  rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('langues') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter la langue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection