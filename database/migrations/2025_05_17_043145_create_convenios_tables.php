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
        Schema::create('convenios', function (Blueprint $table) {
            $table->id('convenio_id');
            $table->foreignId('empresa_id')->constrained('empresas', 'empresa_id')->onDelete('cascade');
            $table->enum('sede', ['San Salvador', 'San Miguel', 'Santa Ana'])->default('San Salvador');
            $table->string('nombre_contacto');
            $table->string('telefono_contacto');
            $table->string('correo_contacto');
            $table->enum('estado', ['activo', 'finalizado'])->default('activo');
            $table->string('tipo_convenio');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('convenio_detalle');
            $table->boolean('convenio_respaldado')->default(true);
            $table->boolean('estado_evidencia')->default(false);
            $table->boolean('habilitado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
