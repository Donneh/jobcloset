<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view shop']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'edit departments']);
        Permission::create(['name' => 'delete departments']);
        Permission::create(['name' => 'view departments']);

        Permission::create(['name' => 'create job titles']);
        Permission::create(['name' => 'edit job titles']);
        Permission::create(['name' => 'delete job titles']);
        Permission::create(['name' => 'view job titles']);

        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'edit locations']);
        Permission::create(['name' => 'delete locations']);
        Permission::create(['name' => 'view locations']);

        Permission::create(['name' => 'view orders']);

        Permission::create(['name' => 'view company settings']);
        Permission::create(['name' => 'edit company settings']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'manager']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'employee']);
        $role->givePermissionTo(['view shop']);
    }
}
