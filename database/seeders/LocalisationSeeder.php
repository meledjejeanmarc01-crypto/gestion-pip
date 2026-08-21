<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Departement;
use App\Models\Region;
use App\Models\SousPrefecture;
use Illuminate\Database\Seeder;

class LocalisationSeeder extends Seeder
{
    /**
     * Découpage administratif (département > sous-préfecture > commune) pour
     * les régions dans lesquelles se trouvent les projets de démonstration.
     * Non exhaustif à l'échelle nationale : centré sur les localités utilisées
     * par ProjetDemoSeeder.
     */
    public function run(): void
    {
        $localites = [
            'Gbêkê'          => ['dept' => ['BKE', 'Bouaké'],     'sp' => ['BKE-C', 'Bouaké'],     'communes' => [['COM-BKE', 'Bouaké']]],
            'Hambol'         => ['dept' => ['KAT', 'Katiola'],    'sp' => ['KAT-C', 'Katiola'],    'communes' => [['COM-KAT', 'Katiola']]],
            'Poro'           => ['dept' => ['KHG', 'Korhogo'],    'sp' => ['KHG-C', 'Korhogo'],    'communes' => [['COM-KHG', 'Korhogo']]],
            'Bounkani'       => ['dept' => ['BNA', 'Bouna'],      'sp' => ['BNA-C', 'Bouna'],      'communes' => [['COM-BNA', 'Bouna']]],
            'San-Pédro'      => ['dept' => ['SPD', 'San-Pédro'],  'sp' => ['SPD-C', 'San-Pédro'],  'communes' => [['COM-SPD', 'San-Pédro']]],
            'Marahoué'       => ['dept' => ['BFL', 'Bouaflé'],    'sp' => ['BFL-C', 'Bouaflé'],    'communes' => [['COM-BFL', 'Bouaflé']]],
            'Iffou'          => ['dept' => ['DKR', 'Daoukro'],    'sp' => ['DKR-C', 'Daoukro'],    'communes' => [['COM-DKR', 'Daoukro']]],
            'Agnéby-Tiassa'  => ['dept' => ['TSL', 'Tiassalé'],   'sp' => ['TSL-C', 'Tiassalé'],   'communes' => [['COM-TSL', 'Tiassalé']]],
            'Lôh-Djiboua'    => ['dept' => ['DIV', 'Divo'],       'sp' => ['DIV-C', 'Divo'],       'communes' => [['COM-DIV', 'Divo']]],
            'Tonkpi'         => ['dept' => ['MAN', 'Man'],        'sp' => ['MAN-C', 'Man'],        'communes' => [['COM-MAN', 'Man']]],
            'Tchologo'       => ['dept' => ['FRK', 'Ferkessédougou'], 'sp' => ['FRK-C', 'Ferkessédougou'], 'communes' => [['COM-FRK', 'Ferkessédougou']]],
            'Haut-Sassandra' => ['dept' => ['DLO', 'Daloa'],      'sp' => ['DLO-C', 'Daloa'],      'communes' => [['COM-DLO', 'Daloa']]],
            'Folon'          => ['dept' => ['MIN', 'Minignan'],   'sp' => ['MIN-C', 'Minignan'],   'communes' => [['COM-MIN', 'Minignan']]],
            'Sud-Comoé'      => ['dept' => ['ABS', 'Aboisso'],    'sp' => ['ABS-C', 'Aboisso'],    'communes' => [['COM-ABS', 'Aboisso']]],
            'Gôh'            => ['dept' => ['GGN', 'Gagnoa'],     'sp' => ['GGN-C', 'Gagnoa'],     'communes' => [['COM-GGN', 'Gagnoa']]],
            'Abidjan'        => ['dept' => ['ABJ', 'Abidjan'],    'sp' => ['ABJ-C', 'Abidjan'],    'communes' => [
                ['COM-YOP', 'Yopougon'],
                ['COM-ABO', 'Abobo'],
                ['COM-COC', 'Cocody'],
            ]],
        ];

        foreach ($localites as $regionNom => $infos) {
            $region = Region::where('nom', $regionNom)->first();

            if (!$region) {
                continue;
            }

            [$deptCode, $deptNom] = $infos['dept'];
            $departement = Departement::firstOrCreate(
                ['code' => $deptCode],
                ['region_id' => $region->id, 'nom' => $deptNom]
            );

            [$spCode, $spNom] = $infos['sp'];
            $sousPrefecture = SousPrefecture::firstOrCreate(
                ['code' => $spCode],
                ['departement_id' => $departement->id, 'nom' => $spNom]
            );

            foreach ($infos['communes'] as [$comCode, $comNom]) {
                Commune::firstOrCreate(
                    ['code' => $comCode],
                    ['sous_prefecture_id' => $sousPrefecture->id, 'nom' => $comNom]
                );
            }
        }
    }
}
