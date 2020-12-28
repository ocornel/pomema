<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\NextOfKin;
use App\Patient;
use App\PatientNok;
use App\User;
use Faker\Generator as Faker;

$factory->define(PatientNok::class, function (Faker $faker) {
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

    # Prepare Noks
    if (NextOfKin::count() < 3) {
        factory(User::class, 30)->create();
    }
    $nok_ids = [];
    foreach (NextOfKin::all() as $nok) {
        array_push($nok_ids, $nok->id);
    }

    return [
        'patient_id' =>$patient_ids[array_rand($patient_ids)],
        'nok_id' =>$nok_ids[array_rand($nok_ids)],
        'created_by' =>$user_ids[array_rand($user_ids)],
        'created_at'=> $faker->dateTimeBetween('-5 months'),
        'updated_at'=> now()
    ];
});
