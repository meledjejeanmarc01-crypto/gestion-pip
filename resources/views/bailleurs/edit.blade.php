@extends('layouts.app')

@section('titre', 'Modifier le bailleur')

@section('contenu')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Modifier le bailleur</h2>
        <p class="text-muted mb-0">
            Modifier les informations du partenaire financier.
        </p>
    </div>

    <a href="{{ route('bailleurs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Retour
    </a>
</div>

<div class="card shadow-sm border-0">
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
              action="{{ route('bailleurs.update', $bailleur) }}">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Code *</label>

                    <input
                        type="text"
                        name="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', $bailleur->code) }}"
                        placeholder="Ex : BAIL-001"
                        required
                    >

                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nom du bailleur *</label>

                    <input
                        type="text"
                        name="nom"
                        class="form-control @error('nom') is-invalid @enderror"
                        value="{{ old('nom', $bailleur->nom) }}"
                        placeholder="Nom du bailleur"
                        required
                    >

                    @error('nom')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Type *</label>

                    <select
                        name="type"
                        class="form-select @error('type') is-invalid @enderror"
                        required
                    >

                        <option value="">-- Sélectionner --</option>

                        <option value="etat"
                            {{ old('type', $bailleur->type) == 'etat' ? 'selected' : '' }}>
                            État
                        </option>

                        <option value="partenaire_bilateral"
                            {{ old('type', $bailleur->type) == 'partenaire_bilateral' ? 'selected' : '' }}>
                            Partenaire bilatéral
                        </option>

                        <option value="partenaire_multilateral"
                            {{ old('type', $bailleur->type) == 'partenaire_multilateral' ? 'selected' : '' }}>
                            Partenaire multilatéral
                        </option>

                        <option value="prive"
                            {{ old('type', $bailleur->type) == 'prive' ? 'selected' : '' }}>
                            Privé
                        </option>

                        <option value="autre"
                            {{ old('type', $bailleur->type) == 'autre' ? 'selected' : '' }}>
                            Autre
                        </option>

                    </select>

                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="contact_email"
                        class="form-control @error('contact_email') is-invalid @enderror"
                        value="{{ old('contact_email', $bailleur->contact_email) }}"
                        placeholder="contact@exemple.com"
                    >

                    @error('contact_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>

                    <input
                        type="text"
                        name="contact_telephone"
                        class="form-control @error('contact_telephone') is-invalid @enderror"
                        value="{{ old('contact_telephone', $bailleur->contact_telephone) }}"
                        placeholder="+225 ..."
                    >

                    @error('contact_telephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('bailleurs.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>
                    Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>
</div>

@endsection