<?php

use App\Credit;
use App\NextOfKin;
use App\Patient;
use App\PatientNok;
use App\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        ini_set('memory_limit', '256M');

        $multiplier = env('DUMMY_MULTIPLIER',1);
//        # USERS
        if ($this->command) $this->command->info('Creating Dummy Users');
        factory(User::class, $multiplier * 1)->create();

        # PATIENTS
        if ($this->command) $this->command->info('Creating Dummy Patients');
        factory(Patient::class, $multiplier * 10)->create();

        # NEXT OF KIN
        if ($this->command) $this->command->info('Creating Dummy Next of Kins');
        factory(NextOfKin::class, $multiplier * 6)->create();

        # PATIENT NEXT OF KIN
        if ($this->command) $this->command->info('Linking Patients to Next of Kins');
        factory(PatientNok::class, $multiplier * 6)->create();

        # CREDITS
        if ($this->command) $this->command->info('Creating Dummy Credits');
        factory(Credit::class, $multiplier * 30)->create();

//        # RESOLVE STUFF
//        if ($this->command) $this->command->info('Resolving Stuff');
//        Utils::ResolveStuff();

    }
}
