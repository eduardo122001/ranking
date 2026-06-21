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
        
    }
}