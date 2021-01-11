<?php

use App\Credit;
use App\NextOfKin;
use App\Patient;
use App\PatientNok;
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
        # ROLES

//        # USERS
//        if ($this->command) $this->command->info('Creating Dummy Users');
//        factory(User::class, 100)->create();

        # PATIENTS
        if ($this->command) $this->command->info('Creating Dummy Patients');
        factory(Patient::class, 200)->create();

        # NEXT OF KIN
        if ($this->command) $this->command->info('Creating Dummy Next of Kins');
        factory(NextOfKin::class, 100)->create();

        # PATIENT NEXT OF KIN
        if ($this->command) $this->command->info('Linking Patients to Next of Kins');
        factory(PatientNok::class, 300)->create();

        # CREDITS
        if ($this->command) $this->command->info('Creating Dummy Credits');
        factory(Credit::class, 300)->create();

//        # RESOLVE STUFF
//        if ($this->command) $this->command->info('Resolving Stuff');
//        Utils::ResolveStuff();

    }
}
