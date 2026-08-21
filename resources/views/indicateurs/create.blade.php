@extends('layouts.app')

@section('titre', 'Nouvel indicateur')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Nouvel indicateur</h2>
            <p class="text-muted">
                Enregistrer un nouvel indicateur de performance
            </p>
        </div>

        <a href="{{ route('indicateurs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Retour
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>
                <i class="bi bi-graph-up me-1"></i>
                Informations de l'indicateur
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

            <form action="{{ route('indicateurs.store') }}" method="POST">

                @csrf

                <div class="row">

                    {{-- Projet --}}
                    <div class="col-md-6 mb-3">

                        <label for="projet_id" class="form-label">
                            Projet <span class="text-danger">*</span>
                        </label>

                        <select
                            name="projet_id"
                            id="projet_id"
                            class="form-select @error('projet_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Sélectionner un projet --
                            </option>

                            @foreach($projets as $projet)

                                <option
                                    value="{{ $projet->id }}"
                                    {{ old('projet_id') == $projet->id ? 'selected' : '' }}
                                >
                                    {{ $projet->code }} - {{ $projet->nom }}
                                </option>

                            @endforeach

                        </select>

                        @error('projet_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Libellé --}}
                    <div class="col-md-6 mb-3">

                        <label for="libelle" class="form-label">
                            Libellé de l'indicateur
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="libelle"
                            id="libelle"
                            value="{{ old('libelle') }}"
                            class="form-control @error('libelle') is-invalid @enderror"
                            placeholder="Exemple : Taux d'avancement physique"
                            required
                        >

                        @error('libelle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Unité --}}
                    <div class="col-md-4 mb-3">

                        <label for="unite" class="form-label">
                            Unité
                        </label>

                        <input
                            type="text"
                            name="unite"
                            id="unite"
                            value="{{ old('unite') }}"
                            class="form-control @error('unite') is-invalid @enderror"
                            placeholder="Exemple : %"
                        >

                        @error('unite')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Valeur cible --}}
                    <div class="col-md-4 mb-3">

                        <label for="valeur_cible" class="form-label">
                            Valeur cible
                        </label>

                        <input
                            type="number"
                            step="any"
                            name="valeur_cible"
                            id="valeur_cible"
                            value="{{ old('valeur_cible') }}"
                            class="form-control @error('valeur_cible') is-invalid @enderror"
                            placeholder="Exemple : 100"
                        >

                        @error('valeur_cible')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Valeur réalisée --}}
                    <div class="col-md-4 mb-3">

                        <label for="valeur_realisee" class="form-label">
                            Valeur réalisée
                        </label>

                        <input
                            type="number"
                            step="any"
                            name="valeur_realisee"
                            id="valeur_realisee"
                            value="{{ old('valeur_realisee') }}"
                            class="form-control @error('valeur_realisee') is-invalid @enderror"
                            placeholder="Exemple : 75"
                        >

                        @error('valeur_realisee')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Date de mesure --}}
                    <div class="col-md-6 mb-3">

                        <label for="date_mesure" class="form-label">
                            Date de mesure
                        </label>

                        <input
                            type="date"
                            name="date_mesure"
                            id="date_mesure"
                            value="{{ old('date_mesure') }}"
                            class="form-control @error('date_mesure') is-invalid @enderror"
                        >

                        @error('date_mesure')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('indicateurs.index') }}"
                        class="btn btn-secondary"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-circle me-1"></i>
                        Enregistrer l'indicateur
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection