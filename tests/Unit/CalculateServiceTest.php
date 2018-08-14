<?php

namespace Tests\Unit;

use App\Exceptions\Calculator\CalculatorNotFoundException;
use App\Models\City;
use App\Models\Scale;
use App\Repositories\Prediction as PredictionRepository;
use App\Services\Calculator\City as CityCalculator;
use App\Services\Calculator\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\FakePredictions;

class CalculateServiceTest extends TestCase
{
    use DatabaseTransactions, FakePredictions;

    protected $scale;
    protected $city;

    /**
     * @test
     */
    public function calculate_predictions_average_between_partners()
    {
        $models = $this->createFakePredictionsInKelvin(3);

        $data = (new PredictionRepository)->getAllByCityName($models[0]->city->name);

        $service = new CityCalculator();

        $result = $service->calculate($data);

        $this->assertEquals(300, $result->predictions()->first());
    }

    /**
     * @test
     */
    public function city_instance_of_return_of_factory()
    {
        $calculator = (new Factory)->calculator('City');

        $this->assertInstanceOf(CityCalculator::class, $calculator);
    }

    /**
     * @test
     */
    public function exception_when_calculator_doesnt_exist()
    {
        $this->expectException(CalculatorNotFoundException::class);

        (new Factory)->calculator('Cities');
    }
}
