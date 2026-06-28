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
        Schema::table('notas', function (Blueprint $table) {
            $table->dropUnique(['estudiante_id', 'semestre_id', 'carrera_id']);
            $table->unique(['estudiante_id', 'semestre_id', 'carrera_id', 'semestre_estudiante']);
        });
    }

    public function down(): void
    {
        Schema::table('notas', function (Blueprint $table) {
            $table->dropUnique(['estudiante_id', 'semestre_id', 'carrera_id', 'semestre_estudiante']);
            $table->unique(['estudiante_id', 'semestre_id', 'carrera_id']);
        });
    }
};
