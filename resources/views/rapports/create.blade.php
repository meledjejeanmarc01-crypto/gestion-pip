@extends('layouts.app')

@section('titre', 'Nouveau rapport')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Nouveau rapport</h2>
            <p class="text-muted mb-0">
                Créer un rapport de suivi des investissements publics.
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
                <i class="bi bi-file-earmark-bar-graph me-1"></i>
                Informations du rapport
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
                  action="{{ route('rapports.store') }}">

                @csrf

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
                            value="{{ old('type') }}"
                            placeholder="Ex : Rapport trimestriel"
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
                            value="{{ old('titre') }}"
                            placeholder="Ex : Rapport de suivi des projets 2026"
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
                            placeholder='Exemple : {"annee":2026,"statut":"en_cours"}'
                        >{{ old('filtres') }}</textarea>

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
                            placeholder='Exemple : {"projets":10,"budget":500000000}'
                        >{{ old('donnees') }}</textarea>

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

                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection