<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCampanhasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('sms_campanhas', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name', 50)->nullable();
            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->text('msg')->nullable();
            $table->enum('status', array('A', 'E', 'F'))->nullable();  //Aguardando, Executando, Finalizado        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sms_campanhas');
    }

}
