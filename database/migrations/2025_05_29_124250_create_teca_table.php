<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teca', function (Blueprint $table) {
            $table->bigIncrements('id_biblioteca');
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->unsignedBigInteger('id_tipo')->nullable();
            $table->unsignedBigInteger('id_id')->nullable();
            $table->string('titulo');
            $table->unsignedBigInteger('id_autor')->nullable();
            $table->unsignedBigInteger('id_editorial')->nullable();
            $table->string('isbn')->nullable();
            $table->unsignedBigInteger('id_ubicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->unsignedBigInteger('id_pres_estado')->nullable();
            $table->string('cargado_por')->nullable();
            $table->string('actualizado_por')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('teca');
    }
}
