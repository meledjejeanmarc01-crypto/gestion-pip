<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titre', "Projet d'Investissement Public") · République de Côte d'Ivoire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="bandeau-ci"></div>

    <div class="d-flex">
        {{-- ===== Barre latérale ===== --}}
        <nav class="sidebar text-white p-3" style="width: 260px;">
            <div class="d-flex align-items-center gap-2 mb-4">
                <img src="{{ asset('images/armoiries-ci.svg') }}" alt="Armoiries de la Côte d'Ivoire" width="38">
                <div class="small">
                    <div class="fw-bold">Projet d'Investissement Public</div>
                    <div class="text-white-50">Côte d'Ivoire</div>
                </div>
            </div>
            <ul class="nav nav-pills flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projets.*') ? 'active' : '' }}" href="{{ route('projets.index') }}">
                        <i class="bi bi-kanban me-2"></i> Projets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carte.*') ? 'active' : '' }}" href="{{ route('carte.index') }}">
                        <i class="bi bi-geo-alt me-2"></i> Carte du territoire
                    </a>
                </li>
            </ul>

            <hr class="text-white-50 mt-4">
            <div class="small text-white-50">
                Connecté(e) en tant que<br>
                <span class="text-white fw-semibold">{{ auth()->user()->name }}</span><br>
                {{ auth()->user()->libelleRole() }}
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100"><i class="bi bi-box-arrow-right me-1"></i> Déconnexion</button>
            </form>
        </nav>

        {{-- ===== Contenu ===== --}}
        <main class="flex-grow-1">
            <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                <h1 class="h5 mb-0">@yield('titre', 'Tableau de bord')</h1>
                <span class="pastille-live"><span class="point"></span> Temps réel actif</span>
            </header>

            <div class="p-4">
                @if (session('succes'))
                    <div class="alert alert-success">{{ session('succes') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $erreur)
                                <li>{{ $erreur }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('contenu')
            </div>
        </main>
    </div>
</body>
</html>
