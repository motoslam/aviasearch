<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $json_path = storage_path('json/airports.json');

        if (file_exists($json_path)) {

            $airports = json_decode(file_get_contents($json_path), true);

            foreach ($airports as $code => $airport) {

                if(isset($airport['airportName'])){

                    Airport::create([
                        'code' => $code,
                        'name_ru' => $airport['airportName']['ru'],
                        'name_en' => $airport['airportName']['en'],
                    ]);

                } else {

                    Airport::create([
                        'code' => $code,
                        'name_ru' => $airport['cityName']['ru'],
                        'name_en' => $airport['cityName']['en'],
                    ]);

                }

            }
        }

    }
}
