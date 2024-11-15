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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('idempleado'); // ID principal de la tabla
            $table->string('nombre', 255);
            $table->string('apellidoPaterno', 255);
            $table->string('apellidoMaterno', 255);
            $table->string('dni', 8)->unique(); // Número de DNI con restricción de unicidad
            $table->date('fechaNacimiento');
            $table->string('direccion', 255)->nullable();
            $table->string('correo', 255)->unique();
            $table->string('telefono', 15)->nullable();
            $table->date('fechaIngreso');
            $table->date('fechaCese')->nullable();
            $table->unsignedBigInteger('idcargo'); // Clave foránea a 'positions'
            $table->timestamps();
            // Definición de la clave foránea
            $table->foreign('idCargo')->references('idCargo')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
