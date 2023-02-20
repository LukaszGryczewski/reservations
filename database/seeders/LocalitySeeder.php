<?php

namespace Database\Seeders;

use App\Models\Locality;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Locality::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker::create();

        for($i=0; $i<100; $i++){
            DB::table('localities')->insert([
                'postal_code' => $faker->postcode,
                'locality'    => $faker->city,
            ]);
        }
    }
}
