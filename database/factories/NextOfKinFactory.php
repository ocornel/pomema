<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\NextOfKin;
use App\User;
use Faker\Generator as Faker;

$factory->define(NextOfKin::class, function (Faker $faker) {
    # Prepare users
    if (User::count() < 3) {
        factory(User::class, 10)->create();
    }
    $user_ids = [];
    foreach (User::all() as $user) {
        array_push($user_ids, $user->id);
    }


    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'other_names' => $faker->lastName,
        'id_number' =>$faker->unique()->numberBetween(1000000,39999999),
        'dob'=> $faker->dateTimeBetween('-50 years'),
        'residence' => $faker->city,
        'work_place' => $faker->city,
        'phone' => $faker->phoneNumber,
        'created_by' =>$user_ids[array_rand($user_ids)],
        'created_at'=> $faker->dateTimeBetween('-5 months'),
        'updated_at'=> now()
    ];
});
