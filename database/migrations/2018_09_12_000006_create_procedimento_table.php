<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedimentoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('procedimentos', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_tprocedimento')->unsigned();
            $table->foreign('id_tprocedimento')->references('id')->on('tprocedimentos');
                        
            $table->string('codigo', 10)->nullable();
            $table->string('name', 2000)->nullable();
            $table->double('valor', 10, 4)->nullable();                     
            
            $table->enum('status', array('A', 'I'))->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('procedimentos');
    }

}
