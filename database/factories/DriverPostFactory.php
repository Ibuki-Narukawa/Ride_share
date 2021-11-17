<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DriverPost;
use Faker\Generator as Faker;

$factory->define(DriverPost::class, function (Faker $faker) {
    $scheduled_date = $faker->dateTimeBetween('+1day', '+30day');
    return [
        'start_datetime' => $scheduled_date,
        'end_datetime' => $scheduled_date->modify('+2hour'),
        'car_model' => 'ソリオ',
        'car_image' => 'solio.jpg',
        'current_location' => $faker->streetAddress,
        'distance' => random_int(1,100),
        'arrival_time' => random_int(1,20),
        'request' => $faker->sentence,
        'user_id' => random_int(1,10),
    ];
});