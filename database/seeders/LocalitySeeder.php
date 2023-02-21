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

        /*$faker = Faker::create();

        for($i=0; $i<100; $i++){
            DB::table('localities')->insert([
                'postal_code' => $faker->postcode,
                'locality'    => $faker->city,
            ]);
        }*/

        $localities = [
            ['locality'=>'Bruxelles','postal_code'=>1000],
            ['locality'=>'Marcinelle','postal_code'=>6001],
            ['locality'=>'Zellik','postal_code'=>1731],
            ['locality'=>'Ecaussinnes','postal_code'=>7190],
            ['locality'=>'Beaumont','postal_code'=>6500],
            ['locality'=>'Anderlecht','postal_code'=>1070],
            ['locality'=>'Watermael-Boitsfort','postal_code'=>1170],
        ];

        //Insert data in the table
        DB::table('localities')->insert($localities);
    }
}
