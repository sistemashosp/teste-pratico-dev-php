<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoSanguineosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_sanguineos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
        });

        DB::table('tipo_sanguineos')->insert(
            array(
                [
                'id' => '1',
                'descricao' => 'O-'
                ],
                [
                    'id' => '2',
                    'descricao' => 'O+'
                    ],
                    [
                        'id' => '3',
                        'descricao' => 'AB-'
                        ],
                        [
                            'id' => '4',
                            'descricao' => 'AB+'
                            ],
                            [
                                'id' => '5',
                                'descricao' => 'A-'
                                ],
                                [
                                    'id' => '6',
                                    'descricao' => 'A+'
                                    ],
                                    [
                                        'id' => '7',
                                        'descricao' => 'B-'
                                        ],
                                        [
                                            'id' => '8',
                                            'descricao' => 'B+'
                                        ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_sanguineos');
    }
}
