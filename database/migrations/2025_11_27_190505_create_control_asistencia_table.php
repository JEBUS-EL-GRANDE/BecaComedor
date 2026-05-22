<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('control_asistencia', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->string('tipo_servicio', 50)->nullable();
            $table->string('observacion', 100)->nullable();
            $table->date('fecha')->nullable(false);
            
            // Llave foránea a Estudiante (id_registro)
            $table->foreignId('id_estudiante')->constrained('estudiante', 'id_registro')
                    ->onUpdate('cascade')->onDelete('cascade');
                
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('control_asistencia'); }
};