<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', static function (Blueprint $table): void {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('email');
            $table->string('datanascimento')->nullable();
            $table->string('genero');
            $table->string('tiposanguineo');
            $table->string('endereco');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('cpf');
            $table->string('tipo_sanguineo_id');

           /* $table->foreign('tipo_sanguineo_id')
               ->references('id')->on('tipo_sanguineo');
            Schema::enableForeignKeyConstraints();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente');
    }
}
