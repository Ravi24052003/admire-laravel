<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = json_decode(File::get(database_path("data/destinations.json")), true);


        foreach ($destinations as $destination) {
            Destination::create([
                'domestic_or_international' => $destination['domestic_or_international'],
                'destination_name' => $destination['destination_name'],
            ]);
        }

    }
}
