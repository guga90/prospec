<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsgruposTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('clientsgrupos', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('id_client')->unsigned()->nullable();
            $table->foreign('id_client')->references('id')->on('clients');   
            $table->integer('id_grupo')->unsigned()->nullable();
            $table->foreign('id_grupo')->references('id')->on('grupos');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clientsgrupos');
    }

}
