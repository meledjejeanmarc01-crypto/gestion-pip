<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('titre', "Projet d'Investissement Public")
        · République de Côte d'Ivoire
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Bandeau aux couleurs de la Côte d'Ivoire --}}
    <div class="bandeau-ci"></div>

    <div class="d-flex">

        {{-- =====================================================
             BARRE LATÉRALE
        ====================================================== --}}
        <nav class="sidebar text-white p-3" style="width: 260px; min-height: 100vh;">

            {{-- Logo et titre --}}
            <div class="d-flex align-items-center gap-2 mb-4">

                <img
                    src="{{ asset('images/armoiries-ci.svg') }}"
                    alt="Armoiries de la Côte d'Ivoire"
                    width="38"
                >

                <div class="small">
                    <div class="fw-bold">
                        SGSPIP
                    </div>

                    <div class="text-white-50">
                        Suivi des investissements publics
                    </div>
                </div>

            </div>


            {{-- =================================================
                 MENU PRINCIPAL
            ================================================== --}}
            <ul class="nav nav-pills flex-column gap-1">

                {{-- Tableau de bord --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}"
                    >

                        <i class="bi bi-speedometer2 me-2"></i>

                        Tableau de bord

                    </a>

                </li>


                {{-- Projets --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('projets.*') ? 'active' : '' }}"
                        href="{{ route('projets.index') }}"
                    >

                        <i class="bi bi-kanban me-2"></i>

                        Projets

                    </a>

                </li>


                {{-- Bailleurs --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('bailleurs.*') ? 'active' : '' }}"
                        href="{{ route('bailleurs.index') }}"
                    >

                        <i class="bi bi-building me-2"></i>

                        Bailleurs

                    </a>

                </li>


                {{-- Indicateurs --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('indicateurs.*') ? 'active' : '' }}"
                        href="{{ route('indicateurs.index') }}"
                    >

                        <i class="bi bi-graph-up-arrow me-2"></i>

                        Indicateurs

                    </a>

                </li>


                {{-- Documents --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}"
                        href="{{ route('documents.index') }}"
                    >

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Documents

                    </a>

                </li>


                {{-- Rapports --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('rapports.*') ? 'active' : '' }}"
                        href="{{ route('rapports.index') }}"
                    >

                        <i class="bi bi-file-earmark-bar-graph me-2"></i>

                        Rapports

                    </a>

                </li>


                {{-- Carte --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('carte.*') ? 'active' : '' }}"
                        href="{{ route('carte.index') }}"
                    >

                        <i class="bi bi-geo-alt me-2"></i>

                        Carte du territoire

                    </a>

                </li>

            </ul>


            {{-- =================================================
                 INFORMATIONS UTILISATEUR
            ================================================== --}}

            <hr class="text-white-50 mt-4">

            <div class="small text-white-50">

                Connecté(e) en tant que

                <br>

                <span class="text-white fw-semibold">
                    {{ auth()->user()->name }}
                </span>

                <br>

                {{ auth()->user()->libelleRole() }}

            </div>


            {{-- Déconnexion --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="mt-3"
            >

                @csrf

                <button
                    class="btn btn-sm btn-outline-light w-100"
                    type="submit"
                >

                    <i class="bi bi-box-arrow-right me-1"></i>

                    Déconnexion

                </button>

            </form>

        </nav>


        {{-- =====================================================
             CONTENU PRINCIPAL
        ====================================================== --}}

        <main class="flex-grow-1">

            {{-- En-tête --}}
            <header
                class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center"
            >

                <h1 class="h5 mb-0">

                    @yield('titre', 'Tableau de bord')

                </h1>


                {{-- Indicateur temps réel --}}
                <span class="pastille-live">

                    <span class="point"></span>

                    Temps réel actif

                </span>

            </header>


            {{-- Contenu de la page --}}
            <div class="p-4">

                {{-- Message de succès --}}
                @if (session('succes'))

                    <div class="alert alert-success">

                        {{ session('succes') }}

                    </div>

                @endif


                {{-- Erreurs --}}
                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $erreur)

                                <li>
                                    {{ $erreur }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- Zone où chaque page injecte son contenu --}}
                @yield('contenu')

            </div>

            {{-- Pied de page institutionnel --}}
            <footer class="app-footer d-flex justify-content-between flex-wrap gap-1">
                <span>
                    &copy; {{ now()->year }} République de Côte d'Ivoire — Ministère de l'Économie, du Plan et du Développement
                </span>
                <span>
                    SGSPIP · Direction Générale du Plan et de la Lutte contre la Pauvreté
                </span>
            </footer>

        </main>

    </div>

</body>
</html>