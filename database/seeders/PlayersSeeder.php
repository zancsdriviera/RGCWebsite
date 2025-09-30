<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlayersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Insert 20 records for players_couples
        foreach (range(1, 20) as $i) {
            DB::table('players_couples')->insert([
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                'hole_number' => $faker->numberBetween(1, 18),
                'date'        => $faker->date('Y-m-d', 'now'),
            ]);
        }

        // Insert 20 records for players_langer
        foreach (range(1, 20) as $i) {
            DB::table('players_langer')->insert([
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                'hole_number' => $faker->numberBetween(1, 18),
                'date'        => $faker->date('Y-m-d', 'now'),
            ]);
        }
    }
}
