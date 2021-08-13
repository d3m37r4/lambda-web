<?php

namespace Database\Seeders;

use DB;
use Exception;
use Illuminate\Database\Seeder;
use App\Models\Reason;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $servers = DB::table('servers')->pluck('id');

        if (is_null($servers)) {
            throw new \Exception('Array containing servers indexes is empty!');
        }

        for ($i = 1; $i <= 100; $i++)  {
            Reason::create([
                'server_id' => $servers->random(),
                'title' => 'Тестовая причина #' .$i,
                'time' => random_int(0, 3600),
            ]);
        }
    }
}
