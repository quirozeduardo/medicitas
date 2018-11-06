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
    }
}
