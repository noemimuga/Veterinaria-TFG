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
    public function run()
{
    Animal::create([
        'nombre' => 'Luna',
        'especie' => 'Perro',
        'raza' => 'Mestizo',
        'edad' => 2,
        'descripcion' => 'Muy cariñosa',
        'refugio_id' => 1
    ]);
}

public function index()
{
    $animales = Animal::all(); 
    return view('adopta.index', compact('animales'));
}


}
