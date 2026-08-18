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

      User::updateOrCreate(
    ['email' => 'meledjejeanmarc01@gmail.com'],
    [
        'name' => 'Jean Marc Meledje',
        'password' => 'Jeanmarc110',
        'role' => 'admin_national',
        'structure_id' => $ministere->id,
        'actif' => true,
    ]
);
    }
}
