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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'public_id' => str_random(8),
        'user_id' => '1',
        'name' => $faker->company,
        'industry' => 'Industry',
        'status' => 'active',
        'contact_name' => $faker->name
    ];
});

$factory->define(App\Invoice::class, function (Faker\Generator $faker) {
    return [
        'client_id' => '1',
        'user_id' => '1',
        'amount' => $faker->randomNumber(3),
        'issue_date' => Carbon\Carbon::now()->subHour(),
        'due_date' => Carbon\Carbon::now()->addWeeks(2),
        'is_paid' => '1',
        'paid_at' => Carbon\Carbon::now()
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'client_id' => '1',
        'user_id' => '1',
        'name' => 'Project Name',
        'desc' => $faker->paragraph,
        'is_complete' => '0'
    ];
});
