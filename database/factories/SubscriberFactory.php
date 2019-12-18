<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name' => $faker->name($gender = null),
        'state' => $faker->randomElement(['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed']),
    ];
});
