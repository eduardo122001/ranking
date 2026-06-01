<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([

            'name' => 'matias',

            'email' => 'matiaapavelsanchecuno@gmail.com',

            'dni' => '71332251',

            'rol_id' => 1,

            'password' => null

        ]);

        User::create([

            'name' => 'matias',

            'email' => 'matias.sanchez@ucsp.edu.pe',

            'dni' => '71300251',

            'rol_id' => 3,

            'password' => null

        ]);

        User::create([

            'name' => 'eduardo',

            'email' => 'eddcrr1@gmail.com',

            'dni' => '48605739',

            'rol_id' => 3,

            'password' => null

        ]);
        User::create([

            'name' => 'juan',

            'email' => 'eduarcrlr@gmail.com',

            'dni' => '48633739',

            'rol_id' => 1,

            'password' => null

        ]);
    }
}