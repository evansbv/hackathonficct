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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gestion_id')->constrained()->onDelele('cascade');
            $table->string('nombre')->unique();
            $table->string('descripcion',1500);
            $table->string('documento',5000);
            $table->date('inicio');
            $table->date('fin');
            $table->string('cabeza');
            $table->string('pie');
            $table->integer('estado'); //0=activo,1=inactivo
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
        Schema::dropIfExists('eventos');
    }
};
