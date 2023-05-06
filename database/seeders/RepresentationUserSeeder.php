<?php

namespace Database\Seeders;

use App\Models\Show;
use App\Models\User;
use App\Models\Location;
use App\Models\Representation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RepresentationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('representation_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $representationUser = [
            [
                'representation_show_title' => 'Ayiti',
                'user_login'=>'bob',
                'representation_places_slug'=>'espace-delvaux-la-venerie',

            ],
            [
                'representation_show_title' => 'Ayiti',
                'user_login'=>'anna',
                'representation_places_slug'=>'dexia-art-center',
            ],
        ];

        //Prepare the data
        foreach ($representationUser as &$data) {

            //Search the type for a given show title
            $show = Show::firstWhere('title',$data['representation_show_title']);

            //Search the type for a given location slug
            $location = Location::firstWhere('slug',$data['representation_places_slug']);


            //Search the artistType for the artist and type found
            $representation = Representation::where([
                ['show_id','=',$show->id ],
                ['location_id','=',$location->id ]
            ])->first();

            //Search the show for a given show's slug
            $user = User::firstWhere('login',$data['user_login']);

            unset($data['representation_show_title']);
            unset($data['representation_places_slug']);
            unset($data['user_login']);
            unset($data['show_slug']);

            $data['representation_id'] = $representation->id;
            $data['user_id'] = $user->id;
        }

        unset($data);

        //Insert data in the table
        DB::table('representation_user')->insert($representationUser);
    }

}
