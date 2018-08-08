<?php

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Partner::class, function (Faker $faker) {
    $user =factory(User::class)->create();
    return [
        'name'    => $faker->company,
        'user_id' => $user->id
    ];
});
