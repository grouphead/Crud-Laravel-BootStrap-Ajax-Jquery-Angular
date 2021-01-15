<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->integer('candidato_id')->unsigned();
            $table->foreign('candidato_id')->references('id')->on('users');
            $table->string('nome');
            $table->integer('vaga_id')->unsigned();
            $table->foreign('vaga_id')->references('id')->on('vagas');
            $table->integer('vagaling_id')->unsigned();
            $table->foreign('vagaling_id')->references('linguagem_id')->on('vagas');
            $table->primary('candidato_id');
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
        Schema::dropIfExists('candidatos');
    }
}
