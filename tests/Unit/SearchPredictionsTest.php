<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction;
use App\Services\Calculator\Result\City as CityResult;
use App\Services\Searcher\Output\City as CityOutput;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\Searcher\Prediction as PredictionService;

class SearchPredictionsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @return void
     */
    public function count_predictions_by_city_name()
    {
        $city = factory(City::class)->create(['name' => 'Amsterdam']);
        factory(Prediction::class, 4)->create(['city_id' => $city->id]);

        $searcher = new PredictionService();

        $predictions = $searcher->find('Amsterdam');

        $this->assertCount(4, $predictions);
    }

    /**
     * @test
     * @return void
     */
    public function city_output_format()
    {
        $date  = Carbon::create(2018, 8, 26, 14, 0, 0);
        $date1 = Carbon::create(2018, 8, 26, 15, 0, 0);

        $predictions = [
            'predictions' => collect([
                $date->format('Y-m-d H:i:s') => 296.15,
                $date1->format('Y-m-d H:i:s') => 280
            ]),
            'city' => collect([
                'name' => 'Amsterdam',
            ]),
            'scale' => collect([
                "name" => "Kelvin",
                "formula" => "x",
                "formula_rollback" => "x"
            ])
        ];

        $output = new CityOutput();

        $expected = [
            'city'        => 'Amsterdam',
            'predictions' => [
                [
                    'datetime' => [
                        'human'  => $date->format('jS \\of F Y H:i'),
                        'normal' => $date->format('Y-m-d H:i'),
                    ],
                    'scale' => [
                        'Fahrenheit' => 73.181,
                        'Celsius'    => 23
                    ],
                ],
                [
                    'datetime' => [
                        'human'  => $date1->format('jS \\of F Y H:i'),
                        'normal' => $date1->format('Y-m-d H:i'),
                    ],
                    'scale' => [
                        'Fahrenheit' => 44.111,
                        'Celsius'    => 6.85
                    ],
                ]
            ],
        ];

        $this->assertEquals($expected, $output->format(new CityResult($predictions)));
    }
}
