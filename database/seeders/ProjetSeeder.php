<?php

namespace Database\Seeders;

use App\Models\Bailleur;
use App\Models\Projet;
use App\Models\Region;
use App\Models\Secteur;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProjetSeeder extends Seeder
{
    /**
     * Jeu de données de démonstration : projets répartis sur plusieurs régions,
     * secteurs et statuts, avec budgets, décaissements, dépenses et tâches
     * pour que le tableau de bord et la carte ne soient pas vides.
     */
    public function run(): void
    {
        $admin = User::first();

        $structure = Structure::firstOrCreate(
            ['code' => 'MPD'],
            ['nom' => 'Ministère du Plan et du Développement', 'type' => 'ministere']
        );

        $bailleurEtat = Bailleur::firstOrCreate(
            ['code' => 'BAI-ETAT'],
            ['nom' => "Budget de l'État de Côte d'Ivoire", 'type' => 'etat']
        );
        $bailleurBM = Bailleur::firstOrCreate(
            ['code' => 'BAI-BM'],
            ['nom' => 'Banque Mondiale', 'type' => 'partenaire_multilateral']
        );

        $secteur = fn (string $code) => Secteur::where('code', $code)->first();
        $region = fn (string $nom) => Region::where('nom', $nom)->first();

        $projets = [
            [
                'code' => 'PROJ-001',
                'nom' => 'Réhabilitation de la voie express Abidjan–Grand-Bassam',
                'description' => "Renforcement et élargissement de la voie express reliant Abidjan à Grand-Bassam, incluant l'éclairage public et la signalisation.",
                'secteur' => 'INF', 'region' => 'Abidjan',
                'cout' => 45_000_000_000, 'statut' => 'en_cours', 'avancement' => 62,
                'debut' => '2024-02-01', 'fin' => '2026-12-31',
            ],
            [
                'code' => 'PROJ-002',
                'nom' => 'Construction du CHR de Man',
                'description' => "Construction d'un centre hospitalier régional de 150 lits avec bloc opératoire et maternité.",
                'secteur' => 'SAN', 'region' => 'Tonkpi',
                'cout' => 18_500_000_000, 'statut' => 'en_cours', 'avancement' => 40,
                'debut' => '2024-06-01', 'fin' => '2026-06-30',
            ],
            [
                'code' => 'PROJ-003',
                'nom' => 'Programme de construction de 50 écoles primaires',
                'description' => "Construction et équipement de 50 écoles primaires dans les zones rurales à faible taux de scolarisation.",
                'secteur' => 'EDU', 'region' => 'Poro',
                'cout' => 9_800_000_000, 'statut' => 'en_retard', 'avancement' => 28,
                'debut' => '2023-09-01', 'fin' => '2025-09-01',
            ],
            [
                'code' => 'PROJ-004',
                'nom' => 'Aménagement hydro-agricole de la vallée du Bandama',
                'description' => "Aménagement de 2 000 hectares de bas-fonds rizicoles et appui aux coopératives agricoles.",
                'secteur' => 'AGR', 'region' => 'Gbêkê',
                'cout' => 12_300_000_000, 'statut' => 'planifie', 'avancement' => 5,
                'debut' => '2026-01-15', 'fin' => '2028-01-15',
            ],
            [
                'code' => 'PROJ-005',
                'nom' => 'Électrification rurale du Bounkani',
                'description' => "Extension du réseau électrique à 120 localités rurales non connectées.",
                'secteur' => 'ENE', 'region' => 'Bounkani',
                'cout' => 7_600_000_000, 'statut' => 'en_cours', 'avancement' => 55,
                'debut' => '2024-03-01', 'fin' => '2026-03-01',
            ],
            [
                'code' => 'PROJ-006',
                'nom' => "Adduction d'eau potable de San-Pédro",
                'description' => "Extension du réseau d'adduction d'eau potable pour desservir 80 000 habitants supplémentaires.",
                'secteur' => 'EAU', 'region' => 'San-Pédro',
                'cout' => 6_200_000_000, 'statut' => 'termine', 'avancement' => 100,
                'debut' => '2022-01-01', 'fin' => '2024-12-01',
            ],
            [
                'code' => 'PROJ-007',
                'nom' => 'Modernisation de la gare routière de Bouaké',
                'description' => "Reconstruction de la gare routière avec quais couverts, guichets et zone commerciale.",
                'secteur' => 'TRA', 'region' => 'Gbêkê',
                'cout' => 4_100_000_000, 'statut' => 'suspendu', 'avancement' => 15,
                'debut' => '2023-05-01', 'fin' => '2025-05-01',
            ],
            [
                'code' => 'PROJ-008',
                'nom' => 'Programme intégré de développement local du Cavally',
                'description' => "Marchés, centres de santé communautaires et pistes rurales dans 15 sous-préfectures du Cavally.",
                'secteur' => 'DEV', 'region' => 'Cavally',
                'cout' => 5_400_000_000, 'statut' => 'en_cours', 'avancement' => 33,
                'debut' => '2025-01-01', 'fin' => '2027-01-01',
            ],
            [
                'code' => 'PROJ-009',
                'nom' => 'Construction du pont de Jacqueville',
                'description' => "Construction d'un pont reliant Jacqueville au réseau routier national, désenclavant la zone.",
                'secteur' => 'INF', 'region' => 'Grands-Ponts',
                'cout' => 22_000_000_000, 'statut' => 'en_cours', 'avancement' => 78,
                'debut' => '2023-01-01', 'fin' => '2026-01-01',
            ],
            [
                'code' => 'PROJ-010',
                'nom' => 'Centres de santé communautaires de la Nawa',
                'description' => "Construction de 12 centres de santé communautaires équipés dans la région de la Nawa.",
                'secteur' => 'SAN', 'region' => 'Nawa',
                'cout' => 3_900_000_000, 'statut' => 'planifie', 'avancement' => 0,
                'debut' => '2026-09-01', 'fin' => '2028-03-01',
            ],
        ];

        foreach ($projets as $donnees) {
            $projet = Projet::firstOrCreate(
                ['code' => $donnees['code']],
                [
                    'nom' => $donnees['nom'],
                    'description' => $donnees['description'],
                    'secteur_id' => $secteur($donnees['secteur'])?->id,
                    'structure_id' => $structure->id,
                    'region_id' => $region($donnees['region'])?->id,
                    'date_debut_prevue' => $donnees['debut'],
                    'date_fin_prevue' => $donnees['fin'],
                    'cout_previsionnel' => $donnees['cout'],
                    'statut' => $donnees['statut'],
                    'avancement_physique' => $donnees['avancement'],
                    'responsable_id' => $admin?->id,
                    'cree_par_id' => $admin?->id,
                ]
            );

            // Un budget annuel de référence
            $projet->budgets()->firstOrCreate(
                ['annee_exercice' => Carbon::parse($donnees['debut'])->year],
                [
                    'bailleur_id' => $bailleurEtat->id,
                    'montant_previsionnel' => $donnees['cout'],
                    'montant_engage' => round($donnees['cout'] * ($donnees['avancement'] / 100)),
                    'montant_disponible' => $donnees['cout'] - round($donnees['cout'] * ($donnees['avancement'] / 100)),
                ]
            );

            // Décaissements et dépenses uniquement pour les projets déjà démarrés
            if ($donnees['avancement'] > 0) {
                $montantDecaisse = round($donnees['cout'] * ($donnees['avancement'] / 100) * 0.9);

                if ($projet->decaissements()->count() === 0) {
                    $projet->decaissements()->create([
                        'bailleur_id' => $bailleurBM->id,
                        'date_decaissement' => Carbon::parse($donnees['debut'])->addMonths(3),
                        'montant' => $montantDecaisse,
                        'source' => 'Première tranche',
                        'enregistre_par_id' => $admin?->id,
                    ]);
                }

                if ($projet->depenses()->count() === 0) {
                    $projet->depenses()->create([
                        'categorie' => 'travaux',
                        'montant' => round($montantDecaisse * 0.7),
                        'date_depense' => Carbon::parse($donnees['debut'])->addMonths(4),
                        'enregistre_par_id' => $admin?->id,
                    ]);
                }

                if ($projet->taches()->count() === 0) {
                    $projet->taches()->create([
                        'libelle' => 'Phase 1 - Études et lancement des travaux',
                        'date_debut' => $donnees['debut'],
                        'date_fin' => Carbon::parse($donnees['debut'])->addMonths(6),
                        'responsable_id' => $admin?->id,
                        'etat' => $donnees['avancement'] >= 100 ? 'termine' : 'en_cours',
                        'pourcentage_avancement' => min($donnees['avancement'] + 20, 100),
                    ]);
                }
            }
        }
    }
}
