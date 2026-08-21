<?php

namespace Database\Seeders;

use App\Models\Bailleur;
use App\Models\Commune;
use App\Models\Projet;
use App\Models\Region;
use App\Models\Secteur;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjetDemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'meledjejeanmarc01@gmail.com')->first();
        $agentFinancier = User::where('email', 'regis.konan@plan.gouv.ci')->first();
        $agentSuivi = User::where('email', 'fatoumata.diaby@plan.gouv.ci')->first();

        $projets = [
            [
                'code' => 'PIP-0001',
                'nom' => "Réhabilitation de la voirie urbaine de Bouaké",
                'description' => "Réfection et bitumage des axes structurants du centre-ville de Bouaké, aménagement de trottoirs et de caniveaux dans les quartiers Commerce et Air France.",
                'secteur' => 'INF', 'structure' => 'MIE', 'region' => 'Gbêkê', 'commune' => 'Bouaké',
                'cout' => 18_500_000_000, 'statut' => 'en_cours', 'avancement' => 62,
                'debut_prevue' => '2024-02-01', 'fin_prevue' => '2026-12-31', 'debut_reelle' => '2024-03-15',
                'responsable' => 'patrick.nguessan@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Terrassement et réfection de la chaussée, axe Air France–Koko", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Pose de pavés et trottoirs, quartier Commerce", 'etat' => 'en_cours', 'avancement' => 55],
                ],
                'indicateurs' => [
                    ['libelle' => "Linéaire de voirie réhabilité", 'unite' => 'km', 'cible' => 18, 'realise' => 11],
                    ['libelle' => "Emplois locaux créés (chantier)", 'unite' => 'emplois', 'cible' => 300, 'realise' => 210],
                ],
            ],
            [
                'code' => 'PIP-0002',
                'nom' => "Construction du Centre Hospitalier Régional de Katiola",
                'description' => "Édification d'un centre hospitalier régional de 120 lits comprenant un bloc opératoire, une maternité et un plateau technique d'imagerie.",
                'secteur' => 'SAN', 'structure' => 'MSHP', 'region' => 'Hambol', 'commune' => 'Katiola',
                'cout' => 6_200_000_000, 'statut' => 'en_cours', 'avancement' => 45,
                'debut_prevue' => '2024-06-01', 'fin_prevue' => '2026-10-31', 'debut_reelle' => '2024-07-01',
                'responsable' => 'estelle.aka@sante.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BM',
                'taches' => [
                    ['libelle' => "Gros œuvre du bloc opératoire", 'etat' => 'en_cours', 'avancement' => 60],
                    ['libelle' => "Équipement médical et plateau technique", 'etat' => 'a_faire', 'avancement' => 0],
                ],
                'indicateurs' => [
                    ['libelle' => "Capacité d'accueil créée", 'unite' => 'lits', 'cible' => 120, 'realise' => 0],
                    ['libelle' => "Taux d'exécution physique", 'unite' => '%', 'cible' => 100, 'realise' => 45],
                ],
            ],
            [
                'code' => 'PIP-0003',
                'nom' => "Extension du réseau d'adduction d'eau potable de Korhogo",
                'description' => "Renforcement de la capacité de production et extension du réseau de distribution d'eau potable de la ville de Korhogo et des localités périphériques.",
                'secteur' => 'EAU', 'structure' => 'MHAS', 'region' => 'Poro', 'commune' => 'Korhogo',
                'cout' => 4_800_000_000, 'statut' => 'termine', 'avancement' => 100,
                'debut_prevue' => '2022-09-01', 'fin_prevue' => '2024-08-31', 'debut_reelle' => '2022-10-01', 'fin_reelle' => '2024-07-20',
                'responsable' => 'awa.coulibaly@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Extension du réseau de distribution", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Réhabilitation du château d'eau", 'etat' => 'termine', 'avancement' => 100],
                ],
                'indicateurs' => [
                    ['libelle' => "Ménages nouvellement raccordés", 'unite' => 'ménages', 'cible' => 6500, 'realise' => 6500],
                    ['libelle' => "Taux de couverture en eau potable", 'unite' => '%', 'cible' => 92, 'realise' => 91],
                ],
            ],
            [
                'code' => 'PIP-0004',
                'nom' => "Électrification rurale de la région du Bounkani",
                'description' => "Extension du réseau électrique national à 42 localités rurales de la région du Bounkani dans le cadre du programme national d'électrification rurale.",
                'secteur' => 'ENE', 'structure' => 'MMPE', 'region' => 'Bounkani', 'commune' => 'Bouna',
                'cout' => 3_100_000_000, 'statut' => 'planifie', 'avancement' => 0,
                'debut_prevue' => '2027-01-01', 'fin_prevue' => '2029-06-30', 'debut_reelle' => null,
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BM',
                'taches' => [
                    ['libelle' => "Étude technique et environnementale", 'etat' => 'a_faire', 'avancement' => 0],
                    ['libelle' => "Appel d'offres travaux", 'etat' => 'a_faire', 'avancement' => 0],
                ],
                'indicateurs' => [
                    ['libelle' => "Localités à électrifier", 'unite' => 'localités', 'cible' => 42, 'realise' => 0],
                ],
            ],
            [
                'code' => 'PIP-0005',
                'nom' => "Construction de 12 salles de classe au Lycée Moderne de San-Pédro",
                'description' => "Construction et équipement de 12 salles de classe supplémentaires et d'un bloc administratif au Lycée Moderne de San-Pédro pour résorber le déficit de capacité d'accueil.",
                'secteur' => 'EDU', 'structure' => 'MENA', 'region' => 'San-Pédro', 'commune' => 'San-Pédro',
                'cout' => 650_000_000, 'statut' => 'termine', 'avancement' => 100,
                'debut_prevue' => '2023-01-10', 'fin_prevue' => '2024-09-01', 'debut_reelle' => '2023-02-01', 'fin_reelle' => '2024-08-15',
                'responsable' => 'losseni.doumbia@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Construction des 12 salles de classe", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Équipement en mobilier scolaire", 'etat' => 'termine', 'avancement' => 100],
                ],
                'indicateurs' => [
                    ['libelle' => "Salles de classe livrées", 'unite' => 'salles', 'cible' => 12, 'realise' => 12],
                    ['libelle' => "Effectifs supplémentaires accueillis", 'unite' => 'élèves', 'cible' => 720, 'realise' => 705],
                ],
            ],
            [
                'code' => 'PIP-0006',
                'nom' => "Aménagement du marché de gros de Bouaflé",
                'description' => "Construction de hangars marchands, de magasins de stockage et aménagement des voies d'accès au marché de gros de Bouaflé.",
                'secteur' => 'DEV', 'structure' => 'MPD', 'region' => 'Marahoué', 'commune' => 'Bouaflé',
                'cout' => 980_000_000, 'statut' => 'en_retard', 'avancement' => 38,
                'debut_prevue' => '2023-05-01', 'fin_prevue' => '2025-04-30', 'debut_reelle' => '2023-06-01',
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BOAD',
                'taches' => [
                    ['libelle' => "Construction des hangars marchands", 'etat' => 'en_cours', 'avancement' => 40],
                    ['libelle' => "Aménagement des voies d'accès", 'etat' => 'bloque', 'avancement' => 15],
                ],
                'indicateurs' => [
                    ['libelle' => "Étals commerciaux livrés", 'unite' => 'étals', 'cible' => 400, 'realise' => 150],
                ],
            ],
            [
                'code' => 'PIP-0007',
                'nom' => "Réhabilitation du barrage hydro-agricole de Kotobi",
                'description' => "Réhabilitation de la digue et du réseau d'irrigation du périmètre hydro-agricole de Kotobi afin de sécuriser les productions rizicoles de la région.",
                'secteur' => 'AGR', 'structure' => 'MINADER', 'region' => 'Iffou', 'commune' => 'Daoukro',
                'cout' => 2_300_000_000, 'statut' => 'suspendu', 'avancement' => 25,
                'debut_prevue' => '2022-11-01', 'fin_prevue' => '2024-11-01', 'debut_reelle' => '2023-01-15',
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Réhabilitation de la digue principale", 'etat' => 'bloque', 'avancement' => 25],
                    ['libelle' => "Curage du réseau d'irrigation", 'etat' => 'a_faire', 'avancement' => 0],
                ],
                'indicateurs' => [
                    ['libelle' => "Superficie irriguée réhabilitée", 'unite' => 'ha', 'cible' => 850, 'realise' => 210],
                ],
            ],
            [
                'code' => 'PIP-0008',
                'nom' => "Construction du pont sur le Bandama à Tiassalé",
                'description' => "Construction d'un pont routier à deux voies sur le fleuve Bandama à Tiassalé, permettant de désenclaver les localités riveraines et de sécuriser le trafic en saison des pluies.",
                'secteur' => 'TRA', 'structure' => 'MTR', 'region' => 'Agnéby-Tiassa', 'commune' => 'Tiassalé',
                'cout' => 9_700_000_000, 'statut' => 'en_cours', 'avancement' => 71,
                'debut_prevue' => '2023-09-01', 'fin_prevue' => '2026-09-30', 'debut_reelle' => '2023-10-01',
                'responsable' => 's.bamba@infrastructures.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'AFD',
                'taches' => [
                    ['libelle' => "Fondations et piles du pont", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Pose du tablier métallique", 'etat' => 'en_cours', 'avancement' => 65],
                ],
                'indicateurs' => [
                    ['libelle' => "Avancement physique de l'ouvrage", 'unite' => '%', 'cible' => 100, 'realise' => 71],
                    ['libelle' => "Longueur d'ouvrage réalisée", 'unite' => 'm', 'cible' => 320, 'realise' => 227],
                ],
            ],
            [
                'code' => 'PIP-0009',
                'nom' => "Modernisation de l'Hôpital Général de Divo",
                'description' => "Réhabilitation du bloc administratif et construction d'un nouveau service de pédiatrie à l'Hôpital Général de Divo.",
                'secteur' => 'SAN', 'structure' => 'MSHP', 'region' => 'Lôh-Djiboua', 'commune' => 'Divo',
                'cout' => 3_750_000_000, 'statut' => 'en_cours', 'avancement' => 30,
                'debut_prevue' => '2025-01-01', 'fin_prevue' => '2027-03-31', 'debut_reelle' => '2025-02-01',
                'responsable' => 'estelle.aka@sante.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BM',
                'taches' => [
                    ['libelle' => "Réhabilitation du bloc administratif", 'etat' => 'en_cours', 'avancement' => 50],
                    ['libelle' => "Construction du nouveau service de pédiatrie", 'etat' => 'en_cours', 'avancement' => 10],
                ],
                'indicateurs' => [
                    ['libelle' => "Taux d'exécution physique", 'unite' => '%', 'cible' => 100, 'realise' => 30],
                ],
            ],
            [
                'code' => 'PIP-0010',
                'nom' => "Programme d'assainissement du District d'Abidjan – Phase II",
                'description' => "Pose de collecteurs d'eaux pluviales et curage des canaux dans les communes d'Abobo et de Yopougon, dans le cadre du programme de lutte contre les inondations à Abidjan.",
                'secteur' => 'INF', 'structure' => 'MHAS', 'region' => 'Abidjan', 'commune' => 'Yopougon',
                'cout' => 42_000_000_000, 'statut' => 'en_cours', 'avancement' => 55,
                'debut_prevue' => '2022-01-01', 'fin_prevue' => '2027-12-31', 'debut_reelle' => '2022-03-01',
                'responsable' => 's.bamba@infrastructures.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BM',
                'taches' => [
                    ['libelle' => "Pose de collecteurs d'eaux pluviales à Yopougon", 'etat' => 'en_cours', 'avancement' => 60],
                    ['libelle' => "Curage des grands canaux à Abobo", 'etat' => 'en_cours', 'avancement' => 50],
                ],
                'indicateurs' => [
                    ['libelle' => "Linéaire de canalisation posé", 'unite' => 'km', 'cible' => 45, 'realise' => 25],
                    ['libelle' => "Population bénéficiaire estimée", 'unite' => 'habitants', 'cible' => 1200000, 'realise' => 660000],
                ],
            ],
            [
                'code' => 'PIP-0011',
                'nom' => "Construction de la route Man–Danané",
                'description' => "Bitumage de la route reliant Man à Danané, incluant la réalisation d'ouvrages de franchissement et la signalisation routière.",
                'secteur' => 'TRA', 'structure' => 'MTR', 'region' => 'Tonkpi', 'commune' => 'Man',
                'cout' => 27_500_000_000, 'statut' => 'en_retard', 'avancement' => 40,
                'debut_prevue' => '2021-06-01', 'fin_prevue' => '2025-12-31', 'debut_reelle' => '2021-08-01',
                'responsable' => 's.bamba@infrastructures.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'UE',
                'taches' => [
                    ['libelle' => "Terrassement général", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Revêtement bitumineux", 'etat' => 'bloque', 'avancement' => 20],
                ],
                'indicateurs' => [
                    ['libelle' => "Linéaire bitumé", 'unite' => 'km', 'cible' => 65, 'realise' => 26],
                ],
            ],
            [
                'code' => 'PIP-0012',
                'nom' => "Extension du réseau électrique de Ferkessédougou",
                'description' => "Installation de postes de transformation et extension du réseau de distribution électrique de la ville de Ferkessédougou et de sa périphérie.",
                'secteur' => 'ENE', 'structure' => 'MMPE', 'region' => 'Tchologo', 'commune' => 'Ferkessédougou',
                'cout' => 5_400_000_000, 'statut' => 'planifie', 'avancement' => 0,
                'debut_prevue' => '2027-03-01', 'fin_prevue' => '2029-02-28', 'debut_reelle' => null,
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'JICA',
                'taches' => [
                    ['libelle' => "Étude de faisabilité technique", 'etat' => 'a_faire', 'avancement' => 0],
                ],
                'indicateurs' => [
                    ['libelle' => "Postes de transformation à installer", 'unite' => 'postes', 'cible' => 8, 'realise' => 0],
                ],
            ],
            [
                'code' => 'PIP-0013',
                'nom' => "Réhabilitation du complexe scolaire de Daloa",
                'description' => "Reconstruction complète d'un complexe scolaire de 20 salles de classe à Daloa, avec réfection des sanitaires et clôture de l'établissement.",
                'secteur' => 'EDU', 'structure' => 'MENA', 'region' => 'Haut-Sassandra', 'commune' => 'Daloa',
                'cout' => 1_150_000_000, 'statut' => 'cloture', 'avancement' => 100,
                'debut_prevue' => '2021-01-01', 'fin_prevue' => '2023-06-30', 'debut_reelle' => '2021-02-15', 'fin_reelle' => '2023-05-10',
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Construction du complexe scolaire", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Réception définitive des travaux", 'etat' => 'termine', 'avancement' => 100],
                ],
                'indicateurs' => [
                    ['libelle' => "Salles de classe livrées", 'unite' => 'salles', 'cible' => 20, 'realise' => 20],
                ],
            ],
            [
                'code' => 'PIP-0014',
                'nom' => "Programme d'hydraulique villageoise de la région du Folon",
                'description' => "Réalisation de points d'eau villageois et formation des comités de gestion de l'eau dans les localités rurales de la région du Folon.",
                'secteur' => 'EAU', 'structure' => 'MHAS', 'region' => 'Folon', 'commune' => 'Minignan',
                'cout' => 1_800_000_000, 'statut' => 'en_cours', 'avancement' => 58,
                'debut_prevue' => '2024-04-01', 'fin_prevue' => '2026-11-30', 'debut_reelle' => '2024-05-01',
                'responsable' => 'awa.coulibaly@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'UE',
                'taches' => [
                    ['libelle' => "Forage de points d'eau villageois", 'etat' => 'en_cours', 'avancement' => 65],
                    ['libelle' => "Formation des comités de gestion de l'eau", 'etat' => 'en_cours', 'avancement' => 40],
                ],
                'indicateurs' => [
                    ['libelle' => "Points d'eau réalisés", 'unite' => 'forages', 'cible' => 60, 'realise' => 35],
                ],
            ],
            [
                'code' => 'PIP-0015',
                'nom' => "Construction du marché central d'Aboisso",
                'description' => "Construction du bâtiment principal du marché central d'Aboisso et équipement des installations sanitaires et électriques.",
                'secteur' => 'DEV', 'structure' => 'MPD', 'region' => 'Sud-Comoé', 'commune' => 'Aboisso',
                'cout' => 720_000_000, 'statut' => 'termine', 'avancement' => 100,
                'debut_prevue' => '2022-03-01', 'fin_prevue' => '2023-12-31', 'debut_reelle' => '2022-04-01', 'fin_reelle' => '2023-11-20',
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BOAD',
                'taches' => [
                    ['libelle' => "Construction du bâtiment principal", 'etat' => 'termine', 'avancement' => 100],
                    ['libelle' => "Équipement sanitaire et électrique", 'etat' => 'termine', 'avancement' => 100],
                ],
                'indicateurs' => [
                    ['libelle' => "Boutiques livrées", 'unite' => 'boutiques', 'cible' => 180, 'realise' => 180],
                ],
            ],
            [
                'code' => 'PIP-0016',
                'nom' => "Aménagement de bas-fonds rizicoles à Gagnoa",
                'description' => "Aménagement hydro-agricole de bas-fonds rizicoles et appui aux coopératives agricoles de la région du Gôh pour l'amélioration de la production vivrière.",
                'secteur' => 'AGR', 'structure' => 'MINADER', 'region' => 'Gôh', 'commune' => 'Gagnoa',
                'cout' => 1_950_000_000, 'statut' => 'en_cours', 'avancement' => 22,
                'debut_prevue' => '2025-03-01', 'fin_prevue' => '2027-06-30', 'debut_reelle' => '2025-04-01',
                'responsable' => 'anderson.guei@plan.gouv.ci',
                'bailleur_principal' => 'BSIE', 'bailleur_secondaire' => 'BAD',
                'taches' => [
                    ['libelle' => "Aménagement hydro-agricole des bas-fonds", 'etat' => 'en_cours', 'avancement' => 25],
                    ['libelle' => "Appui aux coopératives rizicoles", 'etat' => 'en_cours', 'avancement' => 20],
                ],
                'indicateurs' => [
                    ['libelle' => "Superficie aménagée", 'unite' => 'ha', 'cible' => 400, 'realise' => 88],
                ],
            ],
        ];

        foreach ($projets as $p) {
            $secteur = Secteur::where('code', $p['secteur'])->first();
            $structure = Structure::where('code', $p['structure'])->first();
            $region = Region::where('nom', $p['region'])->first();
            $commune = isset($p['commune']) ? Commune::where('nom', $p['commune'])->first() : null;
            $responsable = User::where('email', $p['responsable'])->first();

            $projet = Projet::firstOrCreate(
                ['code' => $p['code']],
                [
                    'nom' => $p['nom'],
                    'description' => $p['description'],
                    'secteur_id' => $secteur?->id,
                    'structure_id' => $structure?->id,
                    'region_id' => $region?->id,
                    'district_id' => $region?->district_id,
                    'departement_id' => $commune?->sousPrefecture?->departement_id,
                    'sous_prefecture_id' => $commune?->sous_prefecture_id,
                    'commune_id' => $commune?->id,
                    'date_debut_prevue' => $p['debut_prevue'],
                    'date_fin_prevue' => $p['fin_prevue'],
                    'date_debut_reelle' => $p['debut_reelle'] ?? null,
                    'date_fin_reelle' => $p['fin_reelle'] ?? null,
                    'cout_previsionnel' => $p['cout'],
                    'statut' => $p['statut'],
                    'avancement_physique' => $p['avancement'],
                    'responsable_id' => $responsable?->id,
                    'cree_par_id' => $admin?->id,
                ]
            );

            // Ne pas dupliquer les données financières/techniques si le projet existait déjà
            if ($projet->wasRecentlyCreated === false && $projet->budgets()->exists()) {
                continue;
            }

            $bailleurPrincipal = Bailleur::where('code', $p['bailleur_principal'])->first();
            $bailleurSecondaire = isset($p['bailleur_secondaire'])
                ? Bailleur::where('code', $p['bailleur_secondaire'])->first()
                : null;

            $partPrincipal = $bailleurSecondaire ? 0.7 : 1.0;
            $partSecondaire = $bailleurSecondaire ? 0.3 : 0.0;
            $anneeExercice = (int) substr($p['debut_prevue'], 0, 4);

            $totalDecaisse = $p['statut'] === 'planifie'
                ? 0
                : (int) round($p['cout'] * min(0.95, ($p['avancement'] / 100) + 0.12));
            $totalDepense = (int) round($totalDecaisse * 0.88);

            // ----- Budgets -----
            $montantPrevPrincipal = (int) round($p['cout'] * $partPrincipal);
            $montantEngagePrincipal = (int) round($totalDecaisse * $partPrincipal);

            $projet->budgets()->create([
                'bailleur_id' => $bailleurPrincipal?->id,
                'annee_exercice' => $anneeExercice,
                'montant_previsionnel' => $montantPrevPrincipal,
                'montant_engage' => $montantEngagePrincipal,
                'montant_disponible' => $montantPrevPrincipal - $montantEngagePrincipal,
            ]);

            if ($bailleurSecondaire) {
                $montantPrevSecondaire = (int) round($p['cout'] * $partSecondaire);
                $montantEngageSecondaire = (int) round($totalDecaisse * $partSecondaire);

                $projet->budgets()->create([
                    'bailleur_id' => $bailleurSecondaire->id,
                    'annee_exercice' => $anneeExercice,
                    'montant_previsionnel' => $montantPrevSecondaire,
                    'montant_engage' => $montantEngageSecondaire,
                    'montant_disponible' => $montantPrevSecondaire - $montantEngageSecondaire,
                ]);
            }

            // ----- Décaissements et dépenses -----
            if ($totalDecaisse > 0) {
                $debutReference = $p['debut_reelle'] ?? $p['debut_prevue'];

                $montantDecaissePrincipal = (int) round($totalDecaisse * $partPrincipal);

                $projet->decaissements()->create([
                    'bailleur_id' => $bailleurPrincipal?->id,
                    'date_decaissement' => date('Y-m-d', strtotime($debutReference . ' +4 months')),
                    'montant' => (int) round($montantDecaissePrincipal * 0.6),
                    'source' => 'Trésor Public — première tranche',
                    'observation' => 'Décaissement conforme au plan de passation des marchés.',
                    'enregistre_par_id' => $agentFinancier?->id,
                ]);

                $projet->decaissements()->create([
                    'bailleur_id' => $bailleurPrincipal?->id,
                    'date_decaissement' => date('Y-m-d', strtotime($debutReference . ' +10 months')),
                    'montant' => (int) round($montantDecaissePrincipal * 0.4),
                    'source' => 'Trésor Public — deuxième tranche',
                    'observation' => 'Décaissement lié à l\'avancement physique constaté sur site.',
                    'enregistre_par_id' => $agentFinancier?->id,
                ]);

                if ($bailleurSecondaire) {
                    $montantDecaisseSecondaire = (int) round($totalDecaisse * $partSecondaire);

                    $projet->decaissements()->create([
                        'bailleur_id' => $bailleurSecondaire->id,
                        'date_decaissement' => date('Y-m-d', strtotime($debutReference . ' +7 months')),
                        'montant' => $montantDecaisseSecondaire,
                        'source' => 'Appui financier extérieur',
                        'observation' => 'Décaissement conjoint dans le cadre de la convention de financement.',
                        'enregistre_par_id' => $agentFinancier?->id,
                    ]);
                }

                $projet->depenses()->create([
                    'categorie' => 'travaux',
                    'montant' => (int) round($totalDepense * 0.75),
                    'date_depense' => date('Y-m-d', strtotime($debutReference . ' +6 months')),
                    'enregistre_par_id' => $agentFinancier?->id,
                ]);

                $projet->depenses()->create([
                    'categorie' => 'equipement',
                    'montant' => (int) round($totalDepense * 0.25),
                    'date_depense' => date('Y-m-d', strtotime($debutReference . ' +11 months')),
                    'enregistre_par_id' => $agentFinancier?->id,
                ]);
            }

            // ----- Tâches -----
            foreach ($p['taches'] as $tache) {
                $projet->taches()->create([
                    'libelle' => $tache['libelle'],
                    'description' => null,
                    'date_debut' => $p['debut_reelle'] ?? $p['debut_prevue'],
                    'date_fin' => $p['fin_prevue'],
                    'responsable_id' => $responsable?->id,
                    'etat' => $tache['etat'],
                    'pourcentage_avancement' => $tache['avancement'],
                ]);
            }

            // ----- Indicateurs -----
            foreach ($p['indicateurs'] as $indicateur) {
                $projet->indicateurs()->create([
                    'libelle' => $indicateur['libelle'],
                    'unite' => $indicateur['unite'],
                    'valeur_cible' => $indicateur['cible'],
                    'valeur_realisee' => $indicateur['realise'],
                    'date_mesure' => $p['statut'] === 'planifie' ? null : now()->subMonths(1)->format('Y-m-d'),
                ]);
            }

            // ----- Documents -----
            $projet->documents()->create([
                'titre' => "Décision d'inscription au budget d'investissement {$anneeExercice}",
                'type' => "Décision d'inscription budgétaire",
                'chemin_fichier' => 'documents/demo/' . Str::slug($p['code'] . '-decision-inscription') . '.pdf',
                'depose_par_id' => $agentSuivi?->id,
            ]);

            if (in_array($p['statut'], ['termine', 'cloture'], true)) {
                $projet->documents()->create([
                    'titre' => 'Procès-verbal de réception définitive des travaux',
                    'type' => 'Procès-verbal de réception',
                    'chemin_fichier' => 'documents/demo/' . Str::slug($p['code'] . '-pv-reception') . '.pdf',
                    'depose_par_id' => $agentSuivi?->id,
                ]);
            }
        }
    }
}
