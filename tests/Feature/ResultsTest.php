<?php

namespace Tests\Feature;

use Database\Seeders\ResultsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class ResultsTest extends TestCase
{
    use RefreshDatabase;

    public function testItStoresResults(): void
    {
        $this->seed(ResultsSeeder::class);

        $driverId = DB::table('drivers')
            ->where('name', 'Max Verstappen')
            ->soleValue('id');

        $this
            ->postJson('/results', [
                'driver_id' => $driverId,
                'sector_1' => '25.344',
                'sector_2' => '25.704',
                'sector_3' => '25.378',
                'lap_total' => '01:16.427',
            ])
            ->assertValid()
            ->assertCreated()
            ->assertExactJson([
                'data' => [
                    'driver' => [
                        'name' => 'Max Verstappen',
                        'team_name' => 'Red Bull Racing',
                    ],
                    'sector_1' => 25.344,
                    'sector_2' => 25.704,
                    'sector_3' => 25.378,
                    'lap_total' => '01:16.427',
                ],
            ]);

        $this->assertDatabaseHas('results', [
            'driver_id' => $driverId,
            'sector_1' => 25.344,
            'sector_2' => 25.704,
            'sector_3' => 25.378,
            'lap_total' => '01:16.427',
        ]);
    }

    public function testItValidatesDriverExists(): void
    {
        $this
            ->postJson('/results', [
                'driver_id' => 1,
            ])
            ->assertInvalid([
                'driver_id' => 'The selected driver id is invalid.',
            ]);
    }

    #[TestWith(['invalid'])]
    #[TestWith(['25.3900'])]
    #[TestWith(['-1.921'])]
    #[TestWith([[]])]
    public function testItValidatesSectorTimes(mixed $input): void
    {
        $this
            ->postJson('/results', [
                'sector_1' => $input,
                'sector_2' => $input,
                'sector_3' => $input,
            ])
            ->assertInvalid(['sector_1', 'sector_2', 'sector_3']);
    }

    #[TestWith(['not-time'])]
    #[TestWith(['16.427'])]
    #[TestWith(['00:16'])]
    #[TestWith(['-01:16.427'])]
    #[TestWith([[]])]
    public function testItValidatesLapTotal(mixed $input): void
    {
        $this
            ->postJson('/results', [
                'lap_total' => $input,
            ])
            ->assertInvalid(['lap_total']);
    }

    public function testItShowsFiveFastestResults(): void
    {
        $this->seed(ResultsSeeder::class);

        $this
            ->getJson('/results')
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    [
                        'driver' => [
                            'name' => 'Max Verstappen',
                            'team_name' => 'Red Bull Racing',
                        ],
                        'sector_1' => 26.344,
                        'sector_2' => 26.704,
                        'sector_3' => 26.378,
                        'lap_total' => '01:19.427',
                    ],
                    [
                        'driver' => [
                            'name' => 'Sergio Perez',
                            'team_name' => 'Red Bull Racing',
                        ],
                        'sector_1' => 26.332,
                        'sector_2' => 26.492,
                        'sector_3' => 26.627,
                        'lap_total' => '01:19.452',
                    ],
                    [
                        'driver' => [
                            'name' => 'Fernando Alonso',
                            'team_name' => 'Aston Martin',
                        ],
                        'sector_1' => 26.291,
                        'sector_2' => 26.793,
                        'sector_3' => 26.661,
                        'lap_total' => '01:19.746',
                    ],
                    [
                        'driver' => [
                            'name' => 'Lewis Hamilton',
                            'team_name' => 'Mercedes',
                        ],
                        'sector_1' => 26.552,
                        'sector_2' => 26.520,
                        'sector_3' => 26.756,
                        'lap_total' => '01:19.869',
                    ],
                    [
                        'driver' => [
                            'name' => 'Carlos Sainz',
                            'team_name' => 'Ferrari',
                        ],
                        'sector_1' => 27.312,
                        'sector_2' => 28.911,
                        'sector_3' => 26.100,
                        'lap_total' => '01:22.433',
                    ],
                ],
            ]);
    }
}
