<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /* Animal::create([
        'nombre' => 'Luna',
        'especie' => 'Perro',
        'raza' => 'Mestizo',
        'edad' => 2,
        'sexo' => 'Hembra',
        'descripcion' => 'Muy cariñosa',
        'refugio_id' => 1
        ]);
        */
        // Crear 50 animales aleatorios
        Animal::factory()->count(50)->create();
    }
}
