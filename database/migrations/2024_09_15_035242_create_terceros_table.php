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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id();
            $table->string('doc_identidad',20)->unique();
            $table->string('nombre',50);
            $table->string('apellidos',50);
            $table->string('email',50);
            $table->string('direccion',100);
            $table->string('telefono_movil',20);
            $table->string('telefono_fijo',20)->nullable();
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
        Schema::dropIfExists('terceros');
    }
};
