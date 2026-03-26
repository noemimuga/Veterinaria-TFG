<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Animal;

class AnimalTest extends TestCase
{
    public function test_can_create_animal()
    {
        $animal = Animal::factory()->create([
            'name' => 'Fido',
            'type' => 'Perro',
        ]);

        $this->assertDatabaseHas('animals', [
            'name' => 'Fido',
            'type' => 'Perro',
        ]);
    }
}
