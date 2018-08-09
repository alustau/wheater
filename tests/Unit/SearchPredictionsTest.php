<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction;
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
}
