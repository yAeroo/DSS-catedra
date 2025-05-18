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
        Schema::create('tipo_empresas', function (Blueprint $table) {
            $table->id('tipo_empresa_id')->autoIncrement();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->boolean('habilitada')->default(true);
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->id('empresa_id')->autoIncrement();
            $table->string('abreviatura_empresa')->unique();
            $table->string('nombre_empresa')->unique();
            $table->string('codigo_donante');
            $table->string('tipo_cooperacion');
            $table->string('tipo_relacion');
            $table->text('direccion');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('tipo_empresa_id')->constrained('tipo_empresas', 'tipo_empresa_id')->onDelete('cascade');
            $table->boolean('habilitada')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('tipo_empresas');
    }
};
