<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    User::create([
        'name' => 'Abrazo Animal',
        'email' => 'abrazoAnimal@gmail.com',
        'password' => Hash::make('1234'),
        'tipo' => 'refugio'
    ]);
    User::create([
        'name' => 'Almudena Arias',
        'email' => 'almudena@gmail.com',
        'password' => Hash::make('1234'),
        'tipo' => 'usuario'
    ]);
}



}
