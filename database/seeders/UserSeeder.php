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

            'rol_id' => 3,

            'password' => null

        ]);
    }
}