<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Supprimer les enregistrements de la table "user_roles"
//DB::table('user_roles')->truncate();


         //Empty the table first
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
         User::truncate();
         DB::statement('SET FOREIGN_KEY_CHECKS=1');

         //Define data
         $users = [
             [
                 'login'=>'bob',
                 'firstname'=>'Bob',
                 'lastname'=>'Sull',
                 'email'=>'bob@gmail.com',
                 'password'=>'rootroot',
                 'langue'=>'fr',
                 'created_at'=>'',
                 'role'=>'admin',
             ],
             [
                 'login'=>'anna',
                 'firstname'=>'Anna',
                 'lastname'=>'Lyse',
                 'email'=>'anna.lyse@gmail.com',
                 'password'=>'rootroot',
                 'langue'=>'en',
                 'created_at'=>'',
                 'role'=>'member',
             ],
         ];

         foreach($users as &$user) {
             $user['created_at'] = Carbon::now()->toDateTimeString();    //date('Y-m-d G:i:s');
             $user['password'] = Hash::make($user['password']);
         }

         //Insert data in the table
         DB::table('users')->insert($users);
    }
}
