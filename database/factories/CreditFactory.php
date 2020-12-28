<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Credit;
use App\Model;
use App\Patient;
use App\User;
use Faker\Generator as Faker;

$factory->define(Credit::class, function (Faker $faker) {
    # Prepare users
    if (User::count() < 3) {
        factory(User::class, 10)->create();
    }
    $user_ids = [];
    foreach (User::all() as $user) {
        array_push($user_ids, $user->id);
    }

    # Prepare Patients
    if (Patient::count() < 3) {
        factory(User::class, 50)->create();
    }
    $patient_ids = [];
    foreach (Patient::all() as $patient) {
        array_push($patient_ids, $patient->id);
    }

    return [
        'patient_id' =>$patient_ids[array_rand($patient_ids)],
        'due_date'=> $faker->dateTimeBetween('-3 months', '3 months'),
        'amount_due' =>random_int(100, 5000),
        'cleared' => $faker->boolean,
        'cleared_on'=> $faker->dateTimeBetween('-2 months'),
        'cleared_by' =>$user_ids[array_rand($user_ids)],
        'created_by' =>$user_ids[array_rand($user_ids)],
        'created_at'=> $faker->dateTimeBetween('-5 months'),
        'updated_at'=> now()
    ];
});
