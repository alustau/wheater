<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction;
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
    public function search_predictions_by_city_name()
    {
        $city = factory(City::class)->create();
        factory(Prediction::class, 4)->create(['city_id' => $city->id]);

        $searcher = new PredictionService();

        $predictions = $searcher->find($city->name);

        $this->assertEquals([
            'city' => $city->name,
            'date' => Carbon::now()->format('jS \\of F Y'),
            'predictions' => [
                'time'        => '01:00',
                'temperature' => [
                    [
                        'scale' => 'Fahrenheit',
                        'value' => 86,
                    ],
                    [
                        'scale' => 'Celsius',
                        'value' => 30,
                    ],
                ],
            ]
        ], $predictions);
    }
}
