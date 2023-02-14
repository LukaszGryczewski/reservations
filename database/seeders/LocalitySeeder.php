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
        //Empty the table first
        Locality::truncate();

        $faker = Faker::create();

        for($i=0; $i<100; $i++){
            DB::table('localities')->insert([
            'postal_code' => $faker->countryCode,
            'locality'    => $faker->city]);
        }
    }
}
