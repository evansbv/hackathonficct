<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelele('cascade');
            $table->foreignId('evento_id')->constrained()->onDelele('cascade');
            $table->foreignId('tematica_id')->constrained()->onDelele('cascade');
            //$table->primary(['equipo_id','evento_id', 'tematica_id']);
            $table->date('fecha');
            $table->string('descripcion');
            $table->integer('estado')->default('0');//0=edicion 1=confirmado
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
        Schema::dropIfExists('participas');
    }
};
