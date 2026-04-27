<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/RoleSeeder.php
    // database/seeders/RoleSeeder.php
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'place bids']);
        Permission::create(['name' => 'list vehicles']);
        Permission::create(['name' => 'edit any listing']);
        Permission::create(['name' => 'access finance dashboard']);

        // Create Roles and Assign Permissions
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        Role::create(['name' => 'moderator'])->givePermissionTo([
            'edit any listing'
        ]);

        Role::create(['name' => 'seller'])->givePermissionTo([
            'list vehicles'
        ]);

        Role::create(['name' => 'buyer'])->givePermissionTo([
            'place bids'
        ]);
    }
}
