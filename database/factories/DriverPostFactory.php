<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DriverPost;
use Faker\Generator as Faker;

$factory->define(DriverPost::class, function (Faker $faker) {
    $scheduled_date = $faker->dateTimeBetween('+1day', '+30day');
    return [
        'start_datetime' => $scheduled_date->format('Y-m-d H:i'),
        'end_datetime' => $scheduled_date->modify('+2 hour')->format('Y-m-d H:i'),
        'car_model' => 'ソリオ',
        'car_image' => 'solio.jpg',
        'max_passengers' => random_int(1,4),
        'current_location' => $faker->address,
        'distance' => random_int(1,100),
        'arrival_time' => random_int(1,20),
        'asking' => $faker->realText(30),
        'user_id' => random_int(1,20),
    ];
});
