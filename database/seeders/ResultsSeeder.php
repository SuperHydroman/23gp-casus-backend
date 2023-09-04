<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $max = DB::table('drivers')->insertGetId([
            'name' => 'Max Verstappen',
            'team_name' => 'Red Bull Racing',
        ]);

        $sergio = DB::table('drivers')->insertGetId([
            'name' => 'Sergio Perez',
            'team_name' => 'Red Bull Racing',
        ]);

        $fernando = DB::table('drivers')->insertGetId([
            'name' => 'Fernando Alonso',
            'team_name' => 'Aston Martin',
        ]);

        $lewis = DB::table('drivers')->insertGetId([
            'name' => 'Lewis Hamilton',
            'team_name' => 'Mercedes',
        ]);

        $carlos = DB::table('drivers')->insertGetId([
            'name' => 'Carlos Sainz',
            'team_name' => 'Ferrari',
        ]);

        $charles = DB::table('drivers')->insertGetId([
            'name' => 'Charles Leclerc',
            'team_name' => 'Ferrari',
        ]);

        DB::table('results')->insert([
            [
                'driver_id' => $charles,
                'sector_1' => '28.352',
                'sector_2' => '27.220',
                'sector_3' => '28.566',
                'lap_total' => '01:24.138',
            ],
            [
                'driver_id' => $fernando,
                'sector_1' => '26.291',
                'sector_2' => '26.793',
                'sector_3' => '26.661',
                'lap_total' => '01:19.746',
            ],
            [
                'driver_id' => $sergio,
                'sector_1' => '26.332',
                'sector_2' => '26.492',
                'sector_3' => '26.627',
                'lap_total' => '01:19.452',
            ],
            [
                'driver_id' => $max,
                'sector_1' => '26.344',
                'sector_2' => '26.704',
                'sector_3' => '26.378',
                'lap_total' => '01:19.427',
            ],
            [
                'driver_id' => $carlos,
                'sector_1' => '27.312',
                'sector_2' => '28.911',
                'sector_3' => '26.100',
                'lap_total' => '01:22.433',
            ],
            [
                'driver_id' => $lewis,
                'sector_1' => '26.552',
                'sector_2' => '26.520',
                'sector_3' => '26.756',
                'lap_total' => '01:19.869',
            ],
        ]);
    }
}
