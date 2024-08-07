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
        Schema::create('equipos_personas', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('equipo_id')->constrained()->onDelele('cascade');
            $table->foreignId('persona_id')->constrained()->onDelele('cascade');
            $table->primary(['equipo_id', 'persona_id']);
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
        Schema::dropIfExists('equipos_personas');
    }
};
