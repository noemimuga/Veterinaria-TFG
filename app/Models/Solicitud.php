<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
      //Para que Laravel sepa cual es el nombre de la tabla que debe mirar
     protected $table = 'solicitudes';

    protected $fillable = [
        'usuario_id',
        'animal_id',
        'mensaje',
        'estado',
    ];

    //RELACIONES
    // Cada solicitud pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Cada solicitud pertenece a un animal
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    //Para saber el estado de las solicitudes

    public function pendiente()
    {
        return $this->estado === 'pendiente';
    }

    public function aceptada()
    {
        return $this->estado === 'aceptada';
    }

    public function rechazada()
    {
        return $this->estado === 'rechazada';
    }

public function user()
{
    return $this->belongsTo(User::class, 'usuario_id');
}

}

