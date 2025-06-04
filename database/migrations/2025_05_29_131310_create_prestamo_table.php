<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->increments('id_prestamo');
            $table->integer('id_biblioteca'); // Asumiendo integer
            $table->string('agente_prestamo');
            $table->date('fecha_solicitud');
            $table->date('fecha_entregado')->nullable(); // Asumiendo que puede ser nulo inicialmente
            $table->date('fecha_devolucion')->nullable(); // Asumiendo que puede ser nulo inicialmente
            $table->date('fecha_estimada_devolucion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamo');
    }
}
