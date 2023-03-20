<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use LocationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArtistSeeder ::class,
            TypeSeeder::class,
            ArtistTypeSeeder::class,
            LocalitySeeder::class,
            LocationSeeder::class,
            ShowSeeder::class
        ]);


    }
}
