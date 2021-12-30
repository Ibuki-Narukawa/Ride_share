<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DriverPost;
use Faker\Generator as Faker;

$factory->define(DriverPost::class, function (Faker $faker) {
    $scheduled_date = $faker->dateTimeBetween('+1day', '+1day');
    return [
        'start_datetime' => $scheduled_date->format('Y-m-d H:i'),
        'end_datetime' => $scheduled_date->modify('+150 day')->format('Y-m-d H:i'),
        'car_model' => 'ソリオ',
        'car_image' => 'solio.jpg',
        'max_passengers' => random_int(1,4),
        'current_location' => $faker->address,
        'asking' => 'おすすめのカフェ教えてください！',
        'user_id' => 1,
    ];
});
