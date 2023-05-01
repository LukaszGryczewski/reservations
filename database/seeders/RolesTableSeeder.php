<?php

namespace Database\Seeders;

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.user'),
            ])->save();
        }
    }
}
