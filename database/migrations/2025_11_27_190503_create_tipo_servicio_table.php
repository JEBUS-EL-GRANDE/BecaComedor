<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipo_servicio', function (Blueprint $table) {
            $table->id('id_tipo_servicio');
            $table->string('nombre_servicio', 50)->nullable(false);
            $table->time('hora_inicio')->nullable(false);
            $table->time('hora_fin')->nullable(false);
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('tipo_servicio'); }
};