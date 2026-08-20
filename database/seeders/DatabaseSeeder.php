<?php

namespace Database\Seeders;

use App\Models\Structure;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            SecteurBailleurSeeder::class,
        ]);

        $ministere = Structure::firstOrCreate(
            ['code' => 'MPD'],
            [
                'nom' => 'Ministère du Plan et du Développement',
                'type' => 'ministere',
                'adresse' => 'Abidjan, Plateau',
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@plan.gouv.ci'],
            [
                'name' => 'Administrateur National',
                'password' => bcrypt('MotDePasse@2026'),
                'role' => 'admin_national',
                'structure_id' => $ministere->id,
            ]
        );

        $this->call([
            ProjetSeeder::class,
        ]);
    }
}
