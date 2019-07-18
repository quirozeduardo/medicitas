<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'permission-read',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'role-read',
            'role-create',
            'role-edit',
            'role-delete',

            'user-read',
            'user-create',
            'user-edit',
            'user-delete'
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
