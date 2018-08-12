<?php
namespace Tests\Traits;


use App\Models\Prediction;
use App\Models\PredictionTime;
use Carbon\Carbon;

trait FakePredictions
{
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
                    'value' => 100
                ]));
            });
    }
}