<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'admin,user');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add permissions
            $this->createPermissions();

            // add roles
            foreach($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);
                // create one user for each role
                if ($role->name === 'admin') {
                    $permissions = \App\Permission::pluck('name')->toArray();
                    $role->syncPermissions($permissions);
                    $this->createUser($role);
                }
            }
            $this->command->info('Roles ' . $input_roles . ' added successfully');
        } else {
            Role::firstOrCreate(['name' => 'admin']);
            $this->command->info('Added only default admin role.');
        }
    }

    private function createUser($role)
    {
        //$user = factory(User::class)->create();
        $user = User::where('email', 'admin@localhost.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Alexys Ernser',
                'email' => 'admin@localhost.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
                'email_verified_at' => new \Carbon\Carbon(),
                'username' => 'admin',
                'phone_number' => '0908778',
            ]);
        }

        $user->assignRole($role->name);

        if( $role->name == 'admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }

    private function createPermissions()
    {
        $permissions = config('permissions');

        foreach($permissions as $package => $permission) {

            foreach ($permission as $each) {
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $each, 'guard_name' => 'web']);
            }

        }
    }
}
