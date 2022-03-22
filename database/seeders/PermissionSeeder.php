<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-People', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-People', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-People', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-People', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Service', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Service', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Service', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Service', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Purchases', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Purchases', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Purchases', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Purchases', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Financial', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Financial', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Financial', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Financial', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Export', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Export', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Export', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Export', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Import', 'guard_name' => 'admin']);
        //*****************************USERS PERMISSIONS*****************************/
        // Permission::create(['name' => 'Create-', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'web']);

    }
}
