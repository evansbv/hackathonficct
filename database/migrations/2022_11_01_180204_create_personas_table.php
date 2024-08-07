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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelele('cascade');
            $table->string('registro')->unique();
            $table->string('carrera');
            $table->string('ci')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('nacimiento');
            $table->string('direccion');
            $table->string('email')->unique();
            $table->string('celular')->unique();
            $table->string('foto');
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
        Schema::dropIfExists('personas');
    }
};
