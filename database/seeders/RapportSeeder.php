<?php

namespace Database\Seeders;

use App\Models\Decaissement;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;

class RapportSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'meledjejeanmarc01@gmail.com')->first();
        $decideur = User::where('email', 'mariam.traore@plan.gouv.ci')->first();

        $budgetTotal = (float) Projet::sum('cout_previsionnel');
        $totalDecaisse = (float) Decaissement::sum('montant');
        $nombreProjets = Projet::count();
        $nombreEnRetard = Projet::where('statut', 'en_retard')->count();

        $rapports = [
            [
                'type' => 'trimestriel',
                'titre' => 'Rapport trimestriel d\'exécution du portefeuille national — T2 2026',
                'filtres' => ['periode' => '2026-T2', 'portee' => 'nationale'],
                'donnees' => [
                    'nombre_projets' => $nombreProjets,
                    'budget_previsionnel_total' => $budgetTotal,
                    'montant_decaisse_total' => $totalDecaisse,
                    'projets_en_retard' => $nombreEnRetard,
                    'observation' => "Taux d'exécution financière globalement conforme aux prévisions, avec un retard localisé sur les projets routiers de l'Ouest.",
                ],
                'genere_par_id' => $admin?->id,
            ],
            [
                'type' => 'sectoriel',
                'titre' => 'Note de suivi — Secteur Infrastructures et Transports',
                'filtres' => ['secteurs' => ['Infrastructures', 'Transports']],
                'donnees' => [
                    'nombre_projets' => Projet::whereHas('secteur', fn ($q) => $q->whereIn('nom', ['Infrastructures', 'Transports']))->count(),
                    'observation' => "Le pont sur le Bandama à Tiassalé et le programme d'assainissement du District d'Abidjan concentrent l'essentiel des décaissements du semestre.",
                ],
                'genere_par_id' => $decideur?->id,
            ],
            [
                'type' => 'regional',
                'titre' => 'Point d\'étape — Portefeuille régional du Gbêkê',
                'filtres' => ['region' => 'Gbêkê'],
                'donnees' => [
                    'nombre_projets' => Projet::where('region_id', optional(Region::where('nom', 'Gbêkê')->first())->id)->count(),
                    'observation' => 'La réhabilitation de la voirie urbaine de Bouaké se poursuit conformément au calendrier révisé.',
                ],
                'genere_par_id' => $admin?->id,
            ],
        ];

        foreach ($rapports as $rapport) {
            Rapport::firstOrCreate(
                ['titre' => $rapport['titre']],
                $rapport
            );
        }
    }
}
