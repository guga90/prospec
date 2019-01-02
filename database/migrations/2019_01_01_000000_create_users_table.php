<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('cpf', 18)->nullable();
            $table->string('cell_phone', 15)->nullable();
            $table->string('home_phone', 15)->nullable();
            $table->string('cep', 11)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('sector', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->enum('status', array('A', 'I'))->nullable();
            $table->enum('profile', array('U', 'A'))->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::unprepared($this->getData());
    }

    public function getData() {
        return "insert  into `users`(`id`,`name`,`cpf`,`cell_phone`,`home_phone`,`cep`,`address`,`complement`,`sector`,`city`,`state`,`email`,`status`,`profile`,`password`,`remember_token`,`created_at`,`updated_at`) values 
                (1,'Gustavo Nascimento Mendanha','012.132.381-52','(62) 98314-1345','(62) 3333-3333','74890-721','Rua Dom Pedro I','N 51','Residencial Ville de France ','Goiânia','GO','gustavomendanha90@gmail.com','A','A','$2y$10$6oUU7g0RQ43ijA1bosjF/eVh9MpUm8iA/PgqrGnRcogtHwDJZw6Ei','obWuLarVsCbDGALoxUWiR0aoLLUriN2FVcfHPhdBTxfdKgg1dRKXshQxVaMZ','2018-01-25 18:36:33','2018-01-25 19:30:59');";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
