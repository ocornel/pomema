<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command) $this->command->info('Creating Default Users');
        User::create([
            'name' => 'System Admin',
            'email' => "sadmin@mcornel.com",
            'password' => bcrypt('Sy5@dm!n')
        ]);
    }
}
