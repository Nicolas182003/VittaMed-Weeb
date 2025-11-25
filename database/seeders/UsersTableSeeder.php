<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nicolas',
            'email' => 'Nikolira6@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nikolira404'), // password
            'cedula' => '',
            'address' => 'Pasaje Interior Lo boza 7084',
            'phone' => '950319731',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nikolira404'), // password
            'role' => 'paciente',
        ]);

        User::create([
            'name' => 'Medico 1',
            'email' => 'doctor1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nikolira404'), // password
            'role' => 'doctor',
        ]);

        User::factory()
            ->count(50)
            ->state(['role' => 'paciente'])
            ->create();
    }
}
