@extends('layouts.app')

@section('titre', 'Modifier le rapport')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Modifier le rapport</h2>

            <p class="text-muted mb-0">
                Modifier les informations du rapport.
            </p>
        </div>

        <a href="{{ route('rapports.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Retour
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header">
            <strong>
                <i class="bi bi-pencil-square me-1"></i>
                Modification du rapport
            </strong>
        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Veuillez corriger les erreurs suivantes :</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST"
                  action="{{ route('rapports.update', $rapport) }}">

                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Type --}}
                    <div class="col-md-6">

                        <label for="type" class="form-label">
                            Type de rapport <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="type"
                            id="type"
                            class="form-control @error('type') is-invalid @enderror"
                            value="{{ old('type', $rapport->type) }}"
                            required
                        >

                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Titre --}}
                    <div class="col-md-6">

                        <label for="titre" class="form-label">
                            Titre <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="titre"
                            id="titre"
                            class="form-control @error('titre') is-invalid @enderror"
                            value="{{ old('titre', $rapport->titre) }}"
                            required
                        >

                        @error('titre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Filtres --}}
                    <div class="col-md-12">

                        <label for="filtres" class="form-label">
                            Filtres
                        </label>

                        <textarea
                            name="filtres"
                            id="filtres"
                            rows="5"
                            class="form-control @error('filtres') is-invalid @enderror"
                        >{{ old('filtres', $rapport->filtres ? json_encode($rapport->filtres, JSON_UNESCAPED_UNICODE) : '') }}</textarea>

                        <small class="text-muted">
                            Format JSON facultatif.
                        </small>

                        @error('filtres')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Données --}}
                    <div class="col-md-12">

                        <label for="donnees" class="form-label">
                            Données du rapport
                        </label>

                        <textarea
                            name="donnees"
                            id="donnees"
                            rows="7"
                            class="form-control @error('donnees') is-invalid @enderror"
                        >{{ old('donnees', $rapport->donnees ? json_encode($rapport->donnees, JSON_UNESCAPED_UNICODE) : '') }}</textarea>

                        <small class="text-muted">
                            Format JSON facultatif.
                        </small>

                        @error('donnees')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('rapports.index') }}"
                       class="btn btn-outline-secondary">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-circle me-1"></i>

                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection