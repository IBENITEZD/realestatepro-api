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
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->softDeletes(); // Esto añadirá la columna deleted_at
        });

        Schema::table('gastos', function (Blueprint $table) {
            //
            $table->softDeletes(); // Esto añadirá la columna deleted_at
        });

        Schema::table('recibos', function (Blueprint $table) {
            //
            $table->softDeletes(); // Esto añadirá la columna deleted_at
        });

        Schema::table('tipos', function (Blueprint $table) {
            //
            $table->softDeletes(); // Esto añadirá la columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->dropSoftDeletes(); // Esto eliminará la columna deleted_at en un rollback
        });

        Schema::table('gastos', function (Blueprint $table) {
            //
            $table->dropSoftDeletes(); // Esto eliminará la columna deleted_at en un rollback
        });

        Schema::table('recibos', function (Blueprint $table) {
            //
            $table->dropSoftDeletes(); // Esto eliminará la columna deleted_at en un rollback
        });

        Schema::table('tipos', function (Blueprint $table) {
            //
            $table->dropSoftDeletes(); // Esto eliminará la columna deleted_at en un rollback
        });
    }
};
