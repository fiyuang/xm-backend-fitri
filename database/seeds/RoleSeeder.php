<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
                      [
                        'name' => 'Admin',
                        'guard_name' => 'web'
                      ],
                      [
                        'name' => 'Guru',
                        'guard_name' => 'web'
                      ],
                      [
                        'name' => 'Talent',
                        'guard_name' => 'web'
                      ]
        ];

        Role::insert($roles);
    }
}
