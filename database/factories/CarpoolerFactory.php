<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Carpooler;
use Faker\Generator as Faker;

$factory->define(Carpooler::class, function (Faker $faker) {
    $scheduled_date = $faker->dateTimeBetween('+1day', '+30day');
    return [
        'start_datetime' => $scheduled_date->format('Y-m-d H:i'),
        'origin' => '日本 、兵庫県神戸市灘区宮山町３丁目１ 六甲駅',
        'latitude_from' => 34.7198228,
        'longitude_from' => 135.2343887,
        'destination' => ' 日本、兵庫県西宮市六湛寺町１０−３ 西宮市',
        'latitude_to' => 34.7375437,
        'longitude_to' => 135.3414417,
        'user_id' => random_int(1,20),
        'driver_post_id' => random_int(15,19),
    ];
});
