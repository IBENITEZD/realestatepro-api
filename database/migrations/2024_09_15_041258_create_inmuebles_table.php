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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('id_propietario');
            $table->foreign('id_propietario')->references('id')->on('terceros');
            $table->string('descripcion',200);
            $table->decimal('area_m2', 7, 2); 
            $table->integer('num_banios'); 
            $table->integer('num_habitaciones'); 
            $table->text('observaciones')->nullable();
            $table->string('direccion',200);
            $table->string('imagen',500);
            $table->string('disponibilidad',3); 
            $table->tinyInteger('amueblado');
            $table->string('nuevo_usado',20);
            $table->string('compra_arriendo',20);
            $table->decimal('valor', 19, 2); 
            $table->unsignedBiginteger('id_tipo');
            $table->foreign('id_tipo')->references('id')->on('tipos');
            $table->unsignedBiginteger('id_ciudad');
            $table->foreign('id_ciudad')->references('id')->on('ciudades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
