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
        Schema::table('solicitudes', function (Blueprint $table) {
           $table->string('datos_contacto')->nullable()->after('animal_id');
        $table->text('vivienda')->nullable()->after('datos_contacto');
        $table->text('motivo')->nullable()->after('vivienda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('solicitudes', function (Blueprint $table) {
        // Por si necesitas revertir los cambios
        $table->dropColumn(['datos_contacto', 'vivienda', 'motivo']);
    });
}
};
