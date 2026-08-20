<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion · Gestion de SGPIP · Côte d'Ivoire</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #0b3d2e 0%, #009e60 55%, #f77f00 130%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="bandeau-ci"></div>
    <div class="login-bg py-5">
        <div class="card login-card p-4 p-md-5">

            {{-- En-tête avec les deux logos officiels --}}
            <div class="d-flex justify-content-center align-items-center gap-4 mb-4">
                <img src="{{ asset('images/armoiries-ci.svg') }}"
                     alt="Armoiries de la République de Côte d'Ivoire" height="72">
                <div class="vr" style="height:60px;"></div>
                <img src="{{ asset('images/logo-ministere-plan.svg') }}"
                     alt="Ministère de l'Économie, du Plan et du Développement" height="72">
            </div>

            <div class="text-center mb-4">
                <h1 class="h5 fw-bold mb-1">RÉPUBLIQUE DE CÔTE D'IVOIRE</h1>
                <p class="text-muted mb-0 small">Union – Discipline – Travail</p>
                <p class="text-muted small">Ministère de l'Économie, du Plan et du Développement</p>
                <hr>
                <h2 class="h6 fw-semibold">Système de gestion et de suivi des projets<br>d'investissement public</h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse électronique professionnelle</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required autofocus placeholder="prenom.nom@plan.gouv.ci">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                </button>
            </form>

            <p class="text-center text-muted small mt-4 mb-0">
                Accès réservé aux agents autorisés de l'administration publique.
            </p>
        </div>
    </div>
</body>
</html>
