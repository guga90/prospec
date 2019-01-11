<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogenviosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('logenvios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_client')->unsigned()->nullable();
            $table->foreign('id_client')->references('id')->on('clients');

            $table->integer('id_email_campanha')->unsigned()->nullable();
            $table->foreign('id_email_campanha')->references('id')->on('email_campanhas'); 
            
            $table->integer('id_sms_campanha')->unsigned()->nullable();
            $table->foreign('id_sms_campanha')->references('id')->on('sms_campanhas'); 

            $table->text('msg', 50)->nullable();
            $table->text('porta', 50)->nullable();
            $table->enum('status', array('S', 'E'))->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('logenvios');
    }

}
