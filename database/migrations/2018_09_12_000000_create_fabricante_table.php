<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricanteTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fabricantes', function (Blueprint $table) {

            $table->increments('id');      
            $table->string('cnpj', 24)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('name_marca', 100)->nullable();
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
        Schema::dropIfExists('fabricantes');
    }

}
