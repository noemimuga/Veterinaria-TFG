<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Animal;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition()
    {
        $sexos = ['Macho', 'Hembra', 'Desconocido'];
        $especies = ['Perro', 'Gato', 'Conejo', 'Ave'];

        return [
            'nombre' => $this->faker->firstName(),
            'especie' => $this->faker->randomElement($especies),
            'raza' => $this->faker->word(),
            'edad' => $this->faker->numberBetween(1, 15),
            'sexo' => $this->faker->randomElement($sexos),
            'descripcion' => $this->faker->sentence(),
            'foto' => null,
            'refugio_id' => 1, // asegúrate que exista un refugio con ID 1
        ];
    }
}
