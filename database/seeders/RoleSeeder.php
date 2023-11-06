<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $role = Role::create(['name' => 'ADMIN']);
        $role = Role::create(['name' => 'FACTURADOR']);
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

    }
}
