<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCampanhaGruposTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('sms_campanha_grupos', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('id_sms_campanha')->unsigned()->nullable();
            $table->foreign('id_sms_campanha')->references('id')->on('sms_campanhas');   
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
        Schema::dropIfExists('sms_campanha_grupos');
    }

}
