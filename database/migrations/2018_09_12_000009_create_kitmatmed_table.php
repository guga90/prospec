<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitmatmedTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('kitmatmeds', function (Blueprint $table) {

            $table->increments('id');
            
            $table->integer('id_kit')->unsigned();
            $table->foreign('id_kit')->references('id')->on('kits');
             
            $table->integer('id_matmed')->unsigned();
            $table->foreign('id_matmed')->references('id')->on('matmeds');
            
            $table->integer('quantidade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('kitmatmeds');
    }

}
