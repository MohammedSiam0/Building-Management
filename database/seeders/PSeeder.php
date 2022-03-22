<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Import', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Import', 'guard_name' => 'admin']);
    }
}
