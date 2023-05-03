<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('user_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $userRoles = [
           /* [
                'user'=>'Admin',
                'role'=>'admin',
            ],*/
            [
                'user'=>'Anna',
                'role'=>'user',
            ],
            [
                'user'=>'Bob',
                'role'=>'user',
            ],
           /* [
                'user'=>'Didem',
                'role'=>'membre',
            ],*/
        ];

        //Prepare the data
        foreach ($userRoles as &$data) {
            //Search the type for a given type
            $user = User::firstWhere('login',$data['user']);

            //Search the type for a given type
            $role = Role::firstWhere('name',$data['role']);

            unset($data['user']);
            unset($data['role']);

            $data['user_id'] = $user->id;
            $data['role_id'] = $role->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('user_roles')->insert($userRoles);
    }
}
