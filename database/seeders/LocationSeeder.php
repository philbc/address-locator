<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();

        $sourcePath = base_path('database'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR .'locations.csv');
        $dataSource = file_exists($sourcePath);

        if (!$dataSource) {
            throw new \Exception('Data source not found!');
        }
            
        $data = array_map('str_getcsv', file($sourcePath));
        $dateNow = Carbon::now();

        foreach ($data as $index => $value) {
            list($address, $latitude, $longitude) = $value;

            DB::table('locations')->insert([
                'address' => $address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
