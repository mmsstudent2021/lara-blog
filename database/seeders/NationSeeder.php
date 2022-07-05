<?php

namespace Database\Seeders;

use App\Models\Nation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nations = ["myanmar","china","singapore","thailand","japan"];
        foreach ($nations as $nation){
            Nation::factory()->create([
                "name" => $nation
            ]);
        }

    }
}
