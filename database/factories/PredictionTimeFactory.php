<?php

use App\Models\Prediction;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\PredictionTime::class, function (Faker $faker) {
    $prediction = factory(Prediction::class)->create();

    return [
        'prediction_id' => $prediction->id,
        'time'          => Carbon::now()->addHours(rand(0, 10)),
        'value'         => $faker->numberBetween(-300, 300),
    ];
});
