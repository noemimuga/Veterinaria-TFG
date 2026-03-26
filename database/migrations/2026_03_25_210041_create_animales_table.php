<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->integer('edad');
            $table->integer('sexo');
            $table->text('descripcion');
            $table->string('foto')->nullable();

            /**
             * colmuna refugio_id -  apunta a otro registro.
             * todos los valores de esta columna deban corresponderse a IDs que existan en la tabla de usuarios
             * onDelete('cascade'): si borramos un usuario - borra automáticamente todo lo que dependa de él
             */

            $table->foreignId('refugio_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
