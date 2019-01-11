<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailServidorTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('email_servidor', function (Blueprint $table) {
            $table->increments('id'); 
            $table->text('name',50)->nullable();                         
            $table->text('host',50)->nullable();                         
            $table->text('porta',50)->nullable();                         
            $table->text('user',50)->nullable();                         
            $table->text('password',50)->nullable();                         
            $table->enum('security', array('SSL', 'TLS'))->nullable();                        
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
        Schema::dropIfExists('email_servidor');
    }

}
