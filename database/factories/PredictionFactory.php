<?php

use App\Models\City;
use App\Models\Partner;
use App\Models\Scale;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Prediction::class, function (Faker $faker) {
    $partner = factory(Partner::class)->create();
    $city    = factory(City::class)->create();
    $scales  = Scale::all();

    return [
        'partner_id' => $partner->id,
        'scale_id'   => $scales->random()->id,
        'city_id'    => $city->id,
        'date'       => Carbon::now(),
        'threshold'  => 1
    ];
});
