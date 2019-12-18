<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'subscriber_id' => $faker->biasedNumberBetween($min = 1, $max = 50),
        'title' => $faker->randomElement(['Email', 'Name', 'Last name', 'Company', 'Country', 'City', 'Phone', 'State', 'ZIP']),
        'type' => $faker->randomElement(['date', 'number', 'string', 'boolean',]),
    ];
});
