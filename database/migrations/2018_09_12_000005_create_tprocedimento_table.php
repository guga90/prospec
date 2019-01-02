<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTprocedimentoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tprocedimentos', function (Blueprint $table) {

            $table->increments('id');      
            $table->string('name', 100)->nullable();
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
        Schema::dropIfExists('tprocedimentos');
    }

}
