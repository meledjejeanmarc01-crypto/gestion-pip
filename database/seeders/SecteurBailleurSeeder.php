<?php

namespace Database\Seeders;

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
    }
}
