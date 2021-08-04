<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maps = array(
            'cs_assault',
            'cs_italy',
            'cs_militia',
            'cs_office',
            'de_aztec',
            'de_cache',
            'de_cbble',
            'de_clan1_mill',
            'de_dust',
            'de_dust2',
            'de_dust2002',
            'de_inferno',
            'de_mirage',
            'de_nuke',
            'de_train',
            'de_tuscan',
            'de_vertigo',
        );

        foreach($maps as $map) {
            Map::create(['name' => $map]);
        }
    }
}
