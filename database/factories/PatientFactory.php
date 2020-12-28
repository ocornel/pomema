<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Patient;
use App\User;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    # Prepare users
    if (User::count() < 3) {
        factory(User::class, 10)->create();
    }
    $user_ids = [];
    foreach (User::all() as $user) {
        array_push($user_ids, $user->id);
    }

    $patient_gender = [Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_MALE, Patient::SEX_FEMALE, Patient::SEX_OTHER];

    return [
        'pc_number' =>$faker->unique()->numberBetween(1,1000000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'other_names' => $faker->lastName,
        'sex' =>$patient_gender[array_rand($patient_gender)],
        'dob'=> $faker->dateTimeBetween('-50 years'),
        'residence' => $faker->city,
        'phone' => $faker->phoneNumber,
        'created_by' =>$user_ids[array_rand($user_ids)],
        'created_at'=> $faker->dateTimeBetween('-5 months'),
        'updated_at'=> now()
    ];
});

