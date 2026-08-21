<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Ministères sectoriels, directions régionales du Plan et collectivités
     * impliqués dans le portefeuille national des projets d'investissement public.
     * Le Ministère du Plan et du Développement (code MPD) est créé séparément
     * dans DatabaseSeeder et n'est pas dupliqué ici.
     */
    public function run(): void
    {
        $structures = [
            ['code' => 'DGPLP', 'nom' => 'Direction Générale du Plan et de la Lutte contre la Pauvreté', 'type' => 'direction', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 21 06 00', 'email' => 'dgplp@plan.gouv.ci'],
            ['code' => 'MSHP', 'nom' => "Ministère de la Santé, de l'Hygiène Publique et de la Couverture Maladie Universelle", 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 22 42 42', 'email' => 'contact@sante.gouv.ci'],
            ['code' => 'MENA', 'nom' => "Ministère de l'Éducation Nationale et de l'Alphabétisation", 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 21 31 00', 'email' => 'contact@education.gouv.ci'],
            ['code' => 'MIE', 'nom' => 'Ministère des Infrastructures Économiques', 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 25 05 00', 'email' => 'contact@infrastructures.gouv.ci'],
            ['code' => 'MINADER', 'nom' => "Ministère de l'Agriculture, du Développement Rural et des Productions Vivrières", 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 21 87 00', 'email' => 'contact@agriculture.gouv.ci'],
            ['code' => 'MHAS', 'nom' => "Ministère de l'Hydraulique, de l'Assainissement et de la Salubrité", 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 30 40 00', 'email' => 'contact@hydraulique.gouv.ci'],
            ['code' => 'MMPE', 'nom' => "Ministère des Mines, du Pétrole et de l'Énergie", 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 25 32 00', 'email' => 'contact@energie.gouv.ci'],
            ['code' => 'MTR', 'nom' => 'Ministère des Transports', 'type' => 'ministere', 'adresse' => 'Abidjan, Plateau', 'telephone' => '27 20 21 12 00', 'email' => 'contact@transports.gouv.ci'],
            ['code' => 'DRP-GBK', 'nom' => 'Direction Régionale du Plan et du Développement du Gbêkê', 'type' => 'direction', 'adresse' => 'Bouaké', 'telephone' => '27 31 63 20 14', 'email' => 'drp.gbeke@plan.gouv.ci'],
            ['code' => 'DRP-POR', 'nom' => 'Direction Régionale du Plan et du Développement du Poro', 'type' => 'direction', 'adresse' => 'Korhogo', 'telephone' => '27 36 86 03 21', 'email' => 'drp.poro@plan.gouv.ci'],
            ['code' => 'DRP-SPD', 'nom' => 'Direction Régionale du Plan et du Développement de San-Pédro', 'type' => 'direction', 'adresse' => 'San-Pédro', 'telephone' => '27 34 71 20 08', 'email' => 'drp.sanpedro@plan.gouv.ci'],
            ['code' => 'CR-GBK', 'nom' => 'Conseil Régional du Gbêkê', 'type' => 'collectivite', 'adresse' => 'Bouaké', 'telephone' => null, 'email' => null],
        ];

        foreach ($structures as $structure) {
            Structure::firstOrCreate(['code' => $structure['code']], $structure);
        }
    }
}
