<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'phone' => $faker->phoneNumber,
        'image' => 'http://grupoheygar.com/wp-content/uploads/2017/03/cropped-LOG.fw_-192x192.png',
        'address' => $faker->streetAddress,
        'roll' => 0,
        'group' => 0,
        'owner' => 1,
    ];
});

$factory->define(App\Product::class, function(Faker\Generator $faker) {
  return [
    'name' => $faker->catchPhrase,
    'percentage' => $faker->numberBetween($min = 0, $max = 100),
    'done' => 0,
    'bill' => $faker->boolean,
    'finished_at' => $faker->dateTime,
    'modify_by' => null,
    'owner' => 1,
  ];
});

$factory->define(App\Response::class, function(Faker\Generator $faker) {
  return [
    'message' => $faker->words(3, true),
    //'created_at' => $faker->dateTimeThisYear,
    //'updated_at' => $faker->dateTimeThisYear,
  ];
});
