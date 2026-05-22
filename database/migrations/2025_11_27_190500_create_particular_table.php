<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('particular', function (Blueprint $table) {
            // Usamos el ID de Personas como PK y FK (relación 1:1)
            $table->foreignId('id_personal')->primary()->constrained('personas', 'id_personal')
                    ->onUpdate('cascade')->onDelete('cascade');

            $table->string('tipo_particular', 50)->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('particular'); }
};