<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailCampanhaGruposTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('email_campanha_grupos', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('id_email_campanha')->unsigned()->nullable();
            $table->foreign('id_email_campanha')->references('id')->on('email_campanhas');   
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
        Schema::dropIfExists('email_campanha_grupos');
    }

}
