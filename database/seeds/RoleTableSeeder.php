<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdministrator = Role::create(['name' => 'administrator']);
        $roleAdministrator->syncPermissions(\Spatie\Permission\Models\Permission::get());

        $roles = [
            'doctor',
            'patient'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        $user = \App\User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'birthdate' => \Carbon\Carbon::now(),
            'gender' => true,
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);
        $user_details = \App\Models\UserDetails::create([
            'user_id' => $user->id
        ]);
        $patient = \App\Models\Medical\Patient::create([
            'user_id' => $user->id
        ]);
        $user->assignRole('administrator');
    }
}
