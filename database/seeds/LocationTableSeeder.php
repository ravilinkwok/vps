<?php

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locationArray[0]['name']      = 'Nandesari';
        $locationArray[0]['code']    = 'NDS';

        $locationArray[1]['name']      = 'Dahej';
        $locationArray[1]['code']    = 'DHJ';

        $locationArray[2]['name']      = 'Roha';
        $locationArray[2]['code']    = 'APL';

        $locationArray[3]['name']      = 'Taloja';
        $locationArray[3]['code']    = 'TCD';

        $locationArray[4]['name']      = 'Hyderabad';
        $locationArray[4]['code']    = 'HSD';



        if (!blank($locationArray)) {
            foreach ($locationArray as $location) {
                Location::create($location);
            }
        }
    }
}
