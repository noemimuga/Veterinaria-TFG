<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    //
     use HasFactory;

  protected $table = 'animales';

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'sexo',
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
