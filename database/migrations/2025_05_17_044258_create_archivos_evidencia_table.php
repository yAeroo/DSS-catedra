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
        Schema::create('archivos_evidencia', function (Blueprint $table) {
            $table->id('archivo_id');
            $table->foreignId('convenio_id')->constrained('convenios', 'convenio_id')->onDelete('cascade');
            $table->string('nombre_archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos_evidencia');
    }
};
