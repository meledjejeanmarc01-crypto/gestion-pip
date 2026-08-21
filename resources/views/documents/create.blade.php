@extends('layouts.app')

@section('contenu')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Nouveau document</h1>

        <a href="{{ route('documents.index') }}" class="btn btn-secondary">
            Retour
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control"
                           value="{{ old('titre') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>

                    <select name="type" class="form-select">
                        <option value="">Sélectionner</option>
                        <option value="Etude">Étude</option>
                        <option value="Contrat">Contrat</option>
                        <option value="Convention">Convention</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                @if(isset($projets))
                    <div class="mb-3">
                        <label class="form-label">Projet</label>

                        <select name="projet_id" class="form-select">
                            <option value="">Sélectionner un projet</option>

                            @foreach($projets as $projet)
                                <option value="{{ $projet->id }}">
                                    {{ $projet->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fichier</label>

                    <input type="file"
                           name="fichier"
                           class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    Enregistrer
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
