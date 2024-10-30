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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('R')->nullable();
            $table->string('centro')->nullable();
            $table->string('modelo')->nullable();
            $table->string('consec')->nullable();
            $table->string('desc')->nullable();
            $table->text('descripcion_actual')->nullable();
            $table->string('tipo')->nullable();
            $table->string('mod')->nullable();
            $table->string('placa')->nullable();
            $table->text('atributos')->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->integer('valor_ingreso')->nullable();
            $table->foreignId('ambiente_id')->nullable()->constrained('ambientes');
            $table->foreignId('profesor_id')->nullable()->constrained('profesores'); $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
