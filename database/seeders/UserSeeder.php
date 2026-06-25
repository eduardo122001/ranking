<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        

        User::create([

            'name' => 'Andre',

            'email' => 'soportetac@cedhinuevaarequipa.edu.pe',

            'dni' => '12121212',

            'rol_id' => 1,

            'password' => null

        ]);
        User::create([

            'name' => 'Rodrigo',

            'email' => '8kdots@gmail.com',

            'dni' => '14141414',

            'rol_id' => 1,

            'password' => null

        ]);
        User::create([

            'name' => 'Rodrigo',

            'email' => 'dev.rsilva@gmail.com',

            'dni' => '14132456',

            'rol_id' => 2,

            'password' => null

        ]);
        User::create([

            'name' => 'Rodrigo',

            'email' => 'rodrigo.silva@ucsp.edu.pe',

            'dni' => '99132456',

            'rol_id' => 3,

            'password' => null

        ]);

        
    }
}