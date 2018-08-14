<?php

namespace Tests\Unit;

use App\Exceptions\Searcher\OutputNotFoundException;
use App\Models\City;
use App\Models\Prediction;
use App\Services\Calculator\Result\City as CityResult;
use App\Services\Searcher\Output\City as CityOutput;
use App\Services\Searcher\Output\Factory;
use App\Services\Searcher\Prediction as SearcherPrediction;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\FakePredictions;

class SearcherServiceTest extends TestCase
{
    use DatabaseTransactions, FakePredictions;

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
                "formula" => '$temperature = x;',
            ])
        ];

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

        $this->assertEquals($expected, (new CityOutput)->format(new CityResult($predictions)));
    }

    /**
     * @test
     */
    public function city_instance_of_return_of_factory_formatters()
    {
        $output = (new Factory)->output('City');

        $this->assertInstanceOf(CityOutput::class, $output);
    }

    /**
     * @test
     */
    public function exception_when_output_doesnt_exist()
    {
        $this->expectException(OutputNotFoundException::class);

        (new Factory)->output('Cities');
    }

    /**
     */
    public function find_city_predictions()
    {
        $this->createFakePredictionsInKelvin(3);

        $searcher = new SearcherPrediction();
        $searcher->city($this->city->name);
    }
}
