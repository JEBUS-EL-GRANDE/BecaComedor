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
        Schema::create('personas', function (Blueprint $table) {
            // Clave Primaria
            $table->id('id_personal'); // Laravel usa `id()` por defecto para autoincremento (INTEGER PRIMARY KEY)
            
            // Campos Obligatorios
            $table->char('nombre', 50);
            $table->char('apellido', 50);
            $table->string('contrasena', 50);
            $table->char('sexo', 1);
            $table->char('ci', 20)->unique(); // Cédula de Identidad (ÚNICA)
            
            // Campos Opcionales/Complementarios
            $table->char('telefono', 15)->nullable();
            $table->char('email', 50)->nullable()->unique(); // Se recomienda que el email también sea único
            $table->char('direccion', 100)->nullable();
            $table->string('rol', 30)->nullable(); // string es alias de VARCHAR
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};