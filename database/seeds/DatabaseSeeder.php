<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->command->info('Seeded the Permissions!');
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');
        $this->call('StatesSeeder');
        $this->command->info('Seeded the states!');
        $this->call('BanksSeeder');
        $this->command->info('Seeded the banks!');
        /*$this->call('UsersSeeder');
        $this->command->info('Seeded the users!');*/
    }
}
