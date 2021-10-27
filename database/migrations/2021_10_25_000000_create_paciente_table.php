<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tipo_sanguineo')->constrained();
            $table->string('nome', 50);
            $table->string('sobrenome', 50);
            $table->string('cpf', 11);
            $table->string('email', 150);
            $table->enum('genero', ['F', 'M']);
            $table->string('endereco', 200);
            $table->string('cidade', 50);
            $table->string('estado', 2);
            $table->string('cep', 9);
            $table->string('frkPlanoSaude', 9);
            $table->date('data_nascimento');
            $table->timestamps();
        });
    }
    // "Kai", "Souza", "KaiCavalcantiSouza@teleworm.us", "10/14/2001", "M", "B+", "Servidão Edmundo Bittencourt 1123", "Florianópolis", "SC", "88048-379","77002286986", "345"
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
