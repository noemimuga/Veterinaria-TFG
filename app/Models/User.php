<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{


    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'comunidad_autonoma',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //Un refugio puede tener muchos animales
    public function animales()
    {
        return $this->hasMany(Animal::class, 'refugio_id');
    }

    //Un usuario puede hacer muchas solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'usuario_id');
    }


    //HELPERS
    //Devuelve true si es un refugio false si no. Ayuda a tener un código más limpio,legible y evitar errores
    public function esRefugio()
    {
        return $this->tipo === 'refugio';
    }

    public function esUsuario()
    {
        return $this->tipo === 'usuario';
    }
}
