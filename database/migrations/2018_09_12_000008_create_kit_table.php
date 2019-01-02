<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('kits', function (Blueprint $table) {

            $table->increments('id');
            
            $table->integer('id_procedimento')->unsigned();
            $table->foreign('id_procedimento')->references('id')->on('procedimentos');
             
            $table->integer('id_especialidade')->unsigned();
            $table->foreign('id_especialidade')->references('id')->on('especialidades');
            
            $table->text('info')->nullable();     
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('kits');
    }

}
