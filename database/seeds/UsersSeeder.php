<?php

use App\User;
class UsersSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Would you like to remove the existing data ? [y|N]', true))
        {
            \Illuminate\Support\Facades\DB::table('users')
                ->where('email', '!=', 'admin@localhost.com')
                ->delete();
            $this->command->info('Deleted all users.');
        }

        // Confirm roles needed
        if ($this->command->confirm('Would you like to create new users? [y|N]', true)) {

            // Ask for roles from input
            $number = $this->command->ask('Enter the number of users to create', '10');

            factory(User::class, $number)->create();
        } else {
            $this->command->info('No user was added!');
        }
    }

}
