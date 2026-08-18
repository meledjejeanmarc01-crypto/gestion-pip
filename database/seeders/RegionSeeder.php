<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Coordonnées approximatives des chefs-lieux des 31 régions + 2 districts
     * autonomes de Côte d'Ivoire, utilisées comme marqueurs sur la carte Leaflet.
     */
    public function run(): void
    {
        $districts = [
            'Abidjan' => ['code' => 'DA', 'autonome' => true],
            'Yamoussoukro' => ['code' => 'DY', 'autonome' => true],
            'Bas-Sassandra' => ['code' => 'D01'],
            'Comoé' => ['code' => 'D02'],
            'Denguélé' => ['code' => 'D03'],
            'Gôh-Djiboua' => ['code' => 'D04'],
            'Lacs' => ['code' => 'D05'],
            'Lagunes' => ['code' => 'D06'],
            'Montagnes' => ['code' => 'D07'],
            'Sassandra-Marahoué' => ['code' => 'D08'],
            'Savanes' => ['code' => 'D09'],
            'Vallée du Bandama' => ['code' => 'D10'],
            'Woroba' => ['code' => 'D11'],
            'Zanzan' => ['code' => 'D12'],
        ];

        $idsDistricts = [];
        foreach ($districts as $nom => $infos) {
            $idsDistricts[$nom] = District::firstOrCreate(
                ['code' => $infos['code']],
                ['nom' => $nom, 'autonome' => $infos['autonome'] ?? false]
            )->id;
        }

        // region => [code, district, lat, lng] (chef-lieu approx.)
        $regions = [
            'Abidjan'        => ['R01', 'Abidjan', 5.3600, -4.0083],
            'Yamoussoukro'   => ['R02', 'Yamoussoukro', 6.8276, -5.2893],
            'Agnéby-Tiassa'  => ['R03', 'Lagunes', 5.8500, -4.4167],
            'Bagoué'         => ['R04', 'Savanes', 9.5167, -6.4833],
            'Bélier'         => ['R05', 'Lacs', 6.8500, -5.2667],
            'Béré'           => ['R06', 'Woroba', 8.4667, -6.8167],
            'Bounkani'       => ['R07', 'Zanzan', 9.5000, -3.2833],
            'Cavally'        => ['R08', 'Montagnes', 7.5500, -8.2333],
            'Folon'          => ['R09', 'Denguélé', 9.3833, -7.5500],
            'Gbêkê'          => ['R10', 'Vallée du Bandama', 7.6833, -5.0333],
            'Gbôklé'         => ['R11', 'Bas-Sassandra', 4.9667, -6.2667],
            'Gôh'            => ['R12', 'Gôh-Djiboua', 6.1333, -5.9500],
            'Grands-Ponts'   => ['R13', 'Lagunes', 5.4667, -4.7833],
            'Guémon'         => ['R14', 'Montagnes', 6.7333, -7.3500],
            'Hambol'         => ['R15', 'Vallée du Bandama', 8.1667, -5.3167],
            'Haut-Sassandra' => ['R16', 'Sassandra-Marahoué', 6.8833, -6.4500],
            'Iffou'          => ['R17', 'Lacs', 7.0000, -4.4333],
            'Indénié-Djuablin' => ['R18', 'Comoé', 6.7333, -3.4833],
            'Kabadougou'     => ['R19', 'Denguélé', 9.4500, -7.6000],
            'La Mé'          => ['R20', 'Lagunes', 5.6667, -3.9833],
            'Lôh-Djiboua'    => ['R21', 'Gôh-Djiboua', 5.8378, -5.3583],
            'Marahoué'       => ['R22', 'Sassandra-Marahoué', 7.0667, -5.9500],
            'Moronou'        => ['R23', 'Lacs', 6.6167, -4.1667],
            'Nawa'           => ['R24', 'Bas-Sassandra', 6.1000, -6.5500],
            'N\'Zi'          => ['R25', 'Lacs', 7.0000, -4.7667],
            'Poro'           => ['R26', 'Savanes', 9.4578, -5.6297],
            'San-Pédro'      => ['R27', 'Bas-Sassandra', 4.7485, -6.6363],
            'Sud-Comoé'      => ['R28', 'Comoé', 5.2833, -3.6000],
            'Tchologo'       => ['R29', 'Savanes', 9.7667, -5.8000],
            'Tonkpi'         => ['R30', 'Montagnes', 7.4000, -7.5500],
            'Worodougou'     => ['R31', 'Woroba', 8.3333, -6.5000],
        ];

        foreach ($regions as $nom => [$code, $district, $lat, $lng]) {
            Region::firstOrCreate(
                ['code' => $code],
                [
                    'nom' => $nom,
                    'district_id' => $idsDistricts[$district] ?? null,
                    'latitude' => $lat,
                    'longitude' => $lng,
                ]
            );
        }
    }
}
