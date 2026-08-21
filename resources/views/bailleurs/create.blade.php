@extends('layouts.app')

@section('titre', 'Nouveau bailleur')

@section('contenu')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Nouveau bailleur</h2>
        <p class="text-muted mb-0">
            Enregistrer un partenaire financier.
        </p>
    </div>

    <a href="{{ route('bailleurs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Retour
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('bailleurs.store') }}">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Code *</label>

                    <input type="text"
                           name="code"
                           class="form-control"
                           value="{{ old('code') }}"
                           placeholder="Ex : BAIL-001"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nom du bailleur *</label>

                    <input type="text"
                           name="nom"
                           class="form-control"
                           value="{{ old('nom') }}"
                           placeholder="Nom du bailleur"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Type *</label>

                    <select name="type" class="form-select" required>

                        <option value="">-- Sélectionner --</option>

                        <option value="etat"
                            {{ old('type') == 'etat' ? 'selected' : '' }}>
                            État
                        </option>

                        <option value="partenaire_bilateral"
                            {{ old('type') == 'partenaire_bilateral' ? 'selected' : '' }}>
                            Partenaire bilatéral
                        </option>

                        <option value="partenaire_multilateral"
                            {{ old('type') == 'partenaire_multilateral' ? 'selected' : '' }}>
                            Partenaire multilatéral
                        </option>

                        <option value="prive"
                            {{ old('type') == 'prive' ? 'selected' : '' }}>
                            Privé
                        </option>

                        <option value="autre"
                            {{ old('type') == 'autre' ? 'selected' : '' }}>
                            Autre
                        </option>

                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>

                    <input type="email"
                           name="contact_email"
                           class="form-control"
                           value="{{ old('contact_email') }}"
                           placeholder="contact@exemple.com">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Téléphone</label>

                    <input type="text"
                           name="contact_telephone"
                           class="form-control"
                           value="{{ old('contact_telephone') }}"
                           placeholder="+225 ...">
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('bailleurs.index') }}"
                   class="btn btn-outline-secondary">
                    Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>
                    Enregistrer
                </button>

            </div>

        </form>

    </div>
</div>

@endsection
