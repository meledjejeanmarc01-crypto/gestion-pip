<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    /**
     * Comptes métier illustrant les différents rôles applicatifs, en plus
     * du compte administrateur national créé dans DatabaseSeeder.
     * Mot de passe de démonstration commun (à changer en production) :
     * Demo@2026
     */
    public function run(): void
    {
        $mpd = Structure::where('code', 'MPD')->first();
        $dgplp = Structure::where('code', 'DGPLP')->first();
        $mie = Structure::where('code', 'MIE')->first();
        $mshp = Structure::where('code', 'MSHP')->first();
        $drpGbeke = Structure::where('code', 'DRP-GBK')->first();
        $drpPoro = Structure::where('code', 'DRP-POR')->first();
        $drpSanPedro = Structure::where('code', 'DRP-SPD')->first();

        $regionGbeke = Region::where('nom', 'Gbêkê')->first();
        $regionPoro = Region::where('nom', 'Poro')->first();
        $regionSanPedro = Region::where('nom', 'San-Pédro')->first();

        $utilisateurs = [
            [
                'name' => 'Aïssata Koné',
                'email' => 'aissata.kone@plan.gouv.ci',
                'role' => 'responsable_national',
                'structure_id' => $dgplp?->id ?? $mpd?->id,
                'region_id' => null,
            ],
            [
                'name' => 'Kouassi Régis Konan',
                'email' => 'regis.konan@plan.gouv.ci',
                'role' => 'agent_financier',
                'structure_id' => $mpd?->id,
                'region_id' => null,
            ],
            [
                'name' => 'Fatoumata Diaby',
                'email' => 'fatoumata.diaby@plan.gouv.ci',
                'role' => 'agent_suivi_evaluation',
                'structure_id' => $dgplp?->id ?? $mpd?->id,
                'region_id' => null,
            ],
            [
                'name' => 'N\'Guessan Yao Patrick',
                'email' => 'patrick.nguessan@plan.gouv.ci',
                'role' => 'responsable_regional',
                'structure_id' => $drpGbeke?->id,
                'region_id' => $regionGbeke?->id,
            ],
            [
                'name' => 'Awa Coulibaly',
                'email' => 'awa.coulibaly@plan.gouv.ci',
                'role' => 'responsable_regional',
                'structure_id' => $drpPoro?->id,
                'region_id' => $regionPoro?->id,
            ],
            [
                'name' => 'Losseni Doumbia',
                'email' => 'losseni.doumbia@plan.gouv.ci',
                'role' => 'responsable_regional',
                'structure_id' => $drpSanPedro?->id,
                'region_id' => $regionSanPedro?->id,
            ],
            [
                'name' => 'Souleymane Bamba',
                'email' => 's.bamba@infrastructures.gouv.ci',
                'role' => 'responsable_projet',
                'structure_id' => $mie?->id,
                'region_id' => null,
            ],
            [
                'name' => 'Estelle Aka Grah',
                'email' => 'estelle.aka@sante.gouv.ci',
                'role' => 'responsable_projet',
                'structure_id' => $mshp?->id,
                'region_id' => null,
            ],
            [
                'name' => 'Mariam Traoré',
                'email' => 'mariam.traore@plan.gouv.ci',
                'role' => 'decideur',
                'structure_id' => $mpd?->id,
                'region_id' => null,
            ],
            [
                'name' => 'Anderson Guei',
                'email' => 'anderson.guei@plan.gouv.ci',
                'role' => 'responsable_departemental',
                'structure_id' => $mpd?->id,
                'region_id' => null,
            ],
        ];

        foreach ($utilisateurs as $utilisateur) {
            User::updateOrCreate(
                ['email' => $utilisateur['email']],
                [
                    'name' => $utilisateur['name'],
                    'password' => 'Demo@2026',
                    'role' => $utilisateur['role'],
                    'structure_id' => $utilisateur['structure_id'],
                    'region_id' => $utilisateur['region_id'],
                    'actif' => true,
                ]
            );
        }
    }
}
