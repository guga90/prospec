<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id'); 
            $table->text('name',50)->nullable();            
            $table->enum('tipo', array('S', 'E'))->nullable();       //SMS, EMAIL                 
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
        Schema::dropIfExists('grupos');
    }

}
