<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'first_name' => 'Administrador',
            'last_name' => 'Administrador',
            'rol' => 'ADMIN',
            'id_type' => 1,
            'document' => '123456789',
            'phone' => '3100000000',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin123*'),
            'status' => 'ACTIVE'
        ]);

        User::create([

            'first_name' => 'Gestion',
            'last_name' => 'Facturador',
            'rol' => 'FACTURADOR',
            'id_type' => 1,
            'document' => '564789315',
            'phone' => '3100000000',
            'email' => 'facturador@gmail.com',
            'password' => bcrypt('Factu123*'),
            'status' => 'ACTIVE'
        ]);
    }
}
