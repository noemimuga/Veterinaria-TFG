<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //

  protected $table = 'animales';

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'descripcion',
        'foto',
        'refugio_id',
        'estado',
    ];
    //RELACIONES
    //Cada animal pertenece a un refugio
    public function refugio()
    {
        return $this->belongsTo(User::class, 'refugio_id');
    }

    //Un animal puede tener muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'animal_id');
    }

    //Para saber si está disponible la adopción
    public function disponible()
    {
        return $this->estado === 'disponible';
    }

    // ¿Ya ha sido adoptado?
    public function adoptado()
    {
        return $this->estado === 'adoptado';
    }

}
