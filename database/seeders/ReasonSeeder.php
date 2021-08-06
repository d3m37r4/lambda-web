<?php

namespace Database\Seeders;

use App\Models\Reason;
use Exception;
use Illuminate\Database\Seeder;

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
        for ($i = 1; $i <= 100; $i++)
        {
            Reason::create([
                'server_id' => random_int(1, 30),
                'title' => 'Тестовая причина #' .$i,
                'time' => random_int(0, 3600),
            ]);
        }
    }
}
