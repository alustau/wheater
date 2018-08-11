<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction;
use App\Models\PredictionTime;
use App\Models\Scale;
use App\Repositories\Prediction as PredictionRepository;
use App\Services\Calculator\City as CityCalculator;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalculateServiceTest extends TestCase
{
    use DatabaseTransactions;

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

        $predictions = $service->calculate($data);

        $this->assertEquals(100, $predictions['predictions']->first());
    }

    protected function createFakePredictionsInKelvin($quantity = 1)
    {
        $date  = Carbon::now()->addHour(rand(1,12));

        $prediction = [
            'scale_id' => $this->scale->id,
            'city_id'  => $this->city->id,
            'date'     => $date->format('Y-m-d')
        ];

        return factory(Prediction::class, $quantity)
            ->create($prediction)
            ->each(function ($prediction) use ($date) {
                $prediction->times()->save(new PredictionTime([
                    'prediction_id' => $prediction->id,
                    'time'  => $date->format('Y-m-d H:00:00'),
                    'value' => 100
                ]));
            });
    }
}
