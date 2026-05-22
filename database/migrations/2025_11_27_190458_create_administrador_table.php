<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id('id_administrador');
            $table->date('ultimo_acceso')->nullable(false);
            $table->date('fecha_inicio_rol')->nullable(false);
            
            // Llave foránea a Personas
            $table->foreignId('id_personal')->constrained('personas', 'id_personal')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('administrador'); }
};
