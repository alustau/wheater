<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Scale;
use App\Repositories\Prediction as PredictionRepository;
use App\Services\Calculator\City as CityCalculator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\FakePredictions;

class CalculateServiceTest extends TestCase
{
    use DatabaseTransactions, FakePredictions;

    protected $scale;
    protected $city;

    public function setUp()
    {
        parent::setUp();

        $this->scale = Scale::where('name', 'Kelvin')->first();
        $this->city  = factory(City::class)->create();
    }

    /**
     * @test
     * @return void
     */
    public function calculate_average_in_kelvin()
    {
        $models = $this->createFakePredictionsInKelvin(3);

        $data = (new PredictionRepository)->getAllByCityName($models[0]->city->name);

        $service = new CityCalculator();

        $result = $service->calculate($data);

        $this->assertEquals(100, $result->predictions()->first());
    }
}
