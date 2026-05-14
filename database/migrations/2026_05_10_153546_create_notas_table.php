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

            $table->decimal('rendimiento', 5, 2);

            $table->decimal('comportamiento', 5, 2);

            $table->decimal('pagos', 5, 2);

            $table->decimal('referente', 5, 2);

            $table->decimal('promedio', 5, 2);

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
