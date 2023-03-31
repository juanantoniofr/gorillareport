<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RegisterUserAPI extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //se crea el usuario en la base de datos
        $user = User::create([
            'name' => 'apiuser',
            'email' => 'apiuser@email.com',
            'password' => bcrypt('pass'),
        ]);

        //se crea token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

    }
}
