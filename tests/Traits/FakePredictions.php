<?php
namespace Tests\Traits;


use App\Models\City;
use App\Models\Prediction;
use App\Models\PredictionTime;
use App\Models\Scale;
use Carbon\Carbon;

trait FakePredictions
{
    public function setUp()
    {
        parent::setUp();

        $this->scale = Scale::where('name', 'Kelvin')->first();
        $this->city  = factory(City::class)->create();
    }

    protected function createFakePredictionsInKelvin($quantity = 1)
    {
        $date  = Carbon::today()->addHour(rand(1,12));

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
                    'value' => 300
                ]));
            });
    }
}