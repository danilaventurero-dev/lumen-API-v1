<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Ticket;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'TipoUser_id' => $faker->randomDigit,     
        'mail' => $faker->unique()->safeEmail,     
        'password' => $faker->unique()->randomNumber,    
    ];
});

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'User_id' => User::all()->random()->id, 
        'ticket_pedido' => $faker->randomNumber,    
    ];
});
