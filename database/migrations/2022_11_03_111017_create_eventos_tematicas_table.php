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
        Schema::create('eventos_tematicas', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('evento_id')->constrained()->onDelele('cascade');
            $table->foreignId('tematica_id')->constrained()->onDelele('cascade');
            $table->primary(['evento_id', 'tematica_id']);
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
        Schema::dropIfExists('eventos_tematicas');
    }
};
