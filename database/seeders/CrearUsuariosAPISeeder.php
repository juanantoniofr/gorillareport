<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CrearUsuariosAPISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => bcrypt('pass'),
             ])->tokens()->create([
                    'name' => 'api',
                    'token' => hash('sha256', 'N7fp6GTjO9CJD1QIhqv0Ty1ZZbJeS3tFIbToFJZQ'),
                    'abilities' => ['api-access'],
            ]);
    }
}
