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
        Schema::create('notas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('estudiante_id')->constrained('users');

            $table->foreignId('semestre_id')->constrained('semestres');

            $table->foreignId('carrera_id')->constrained('carreras');

            $table->integer('semestre_estudiante');

            $table->decimal('rendimiento', 8, 2);

            $table->decimal('comportamiento', 8, 2);

            $table->decimal('pagos', 8, 2);

            $table->decimal('referente', 8, 2);

            $table->decimal('promedio', 8, 2);

            $table->integer('ranking')->default(0);

            $table->unique([
                'estudiante_id',
                'semestre_id',
                'carrera_id'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
