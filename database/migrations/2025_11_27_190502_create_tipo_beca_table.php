<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipo_beca', function (Blueprint $table) {
            $table->id('id_tipo');
            $table->string('tipo_beca', 50)->nullable();
            $table->integer('duracion')->nullable();
            $table->string('descripcion', 100)->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('tipo_beca'); }
};