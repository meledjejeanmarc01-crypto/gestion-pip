<?php

namespace Database\Seeders;

use App\Models\Bailleur;
use App\Models\Secteur;
use Illuminate\Database\Seeder;

class SecteurBailleurSeeder extends Seeder
{
    public function run(): void
    {
        $secteurs = [
            'INF' => 'Infrastructures',
            'SAN' => 'Santé',
            'EDU' => 'Éducation',
            'AGR' => 'Agriculture',
            'ENE' => 'Énergie',
            'EAU' => 'Eau potable',
            'TRA' => 'Transports',
            'DEV' => 'Développement local',
        ];

        foreach ($secteurs as $code => $nom) {
            Secteur::firstOrCreate(['code' => $code], ['nom' => $nom]);
        }

        // Bailleurs de fonds effectivement actifs sur le portefeuille des
        // projets d'investissement public en Côte d'Ivoire (État + PTF).
        $bailleurs = [
            [
                'code' => 'BSIE',
                'nom' => "État de Côte d'Ivoire — Budget Spécial d'Investissement et d'Équipement",
                'type' => 'etat',
                'contact_email' => 'bsie@budget.gouv.ci',
                'contact_telephone' => '27 20 21 05 00',
            ],
            [
                'code' => 'BM',
                'nom' => 'Banque Mondiale',
                'type' => 'partenaire_multilateral',
                'contact_email' => 'abidjan@worldbank.org',
                'contact_telephone' => '27 22 40 04 00',
            ],
            [
                'code' => 'BAD',
                'nom' => 'Banque Africaine de Développement',
                'type' => 'partenaire_multilateral',
                'contact_email' => 'civ.field@afdb.org',
                'contact_telephone' => '27 20 26 28 28',
            ],
            [
                'code' => 'AFD',
                'nom' => 'Agence Française de Développement',
                'type' => 'partenaire_bilateral',
                'contact_email' => 'ab@afd.fr',
                'contact_telephone' => '27 20 31 85 00',
            ],
            [
                'code' => 'UE',
                'nom' => "Délégation de l'Union Européenne en Côte d'Ivoire",
                'type' => 'partenaire_multilateral',
                'contact_email' => 'delegation-cote-divoire@eeas.europa.eu',
                'contact_telephone' => '27 22 40 12 00',
            ],
            [
                'code' => 'BOAD',
                'nom' => 'Banque Ouest Africaine de Développement',
                'type' => 'partenaire_multilateral',
                'contact_email' => 'siege@boad.org',
                'contact_telephone' => '27 20 20 65 00',
            ],
            [
                'code' => 'JICA',
                'nom' => 'Agence Japonaise de Coopération Internationale',
                'type' => 'partenaire_bilateral',
                'contact_email' => 'ci_oso_rep@jica.go.jp',
                'contact_telephone' => '27 22 44 44 40',
            ],
            [
                'code' => 'EXIM-CN',
                'nom' => 'Export-Import Bank of China',
                'type' => 'partenaire_bilateral',
                'contact_email' => 'abidjan.office@eximbankchina.cn',
                'contact_telephone' => null,
            ],
        ];

        foreach ($bailleurs as $bailleur) {
            Bailleur::firstOrCreate(['code' => $bailleur['code']], $bailleur);
        }
    }
}
