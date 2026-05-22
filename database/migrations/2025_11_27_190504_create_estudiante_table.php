<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id('id_registro');
            $table->decimal('promedio_academico', 4, 2)->nullable();
            $table->string('situacion_academica', 50)->nullable();
            
            // Llaves foráneas
            $table->foreignId('id_personal')->constrained('personas', 'id_personal')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreignId('id_carrera')->constrained('carrera', 'id_carrera')
                ->onUpdate('cascade')->onDelete('cascade');
                
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('estudiante'); }
};