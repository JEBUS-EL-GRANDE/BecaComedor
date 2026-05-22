<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('encargado', function (Blueprint $table) {
            $table->id('id_encargado');
            $table->string('cargo', 50)->nullable(false);
            $table->string('turno', 20)->nullable(false);
            
            // Llave foránea a Personas
            $table->foreignId('id_personal')->constrained('personas', 'id_personal')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('encargado'); }
};