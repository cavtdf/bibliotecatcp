<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresMovimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pres_movimiento', function (Blueprint $table) {
            $table->increments('id_pres_movimiento');
            $table->integer('id_prestamo');
            $table->integer('id_tipo_movimiento');
            $table->date('fecha_movimiento');
            $table->string('agente_responsable');
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
        Schema::dropIfExists('pres_movimiento');
    }
}
