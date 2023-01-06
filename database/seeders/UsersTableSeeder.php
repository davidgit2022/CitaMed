<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@citasmedicas.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'cedula' => '1085300505',
            'address' => 'calle 12',
            'phone' => '744565494',
            'role' => 'admin',
        ]);

        //Paciente
        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@citasmedicas.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role' => 'paciente',
        ]);

        //Doctor
        User::create([
            'name' => 'Medico1',
            'email' => 'medico1@citasmedicas.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role' => 'doctor',
        ]);

        User::factory()
        ->count(100)
        ->state(['role' => 'paciente'])
        ->create();
    }
}
