<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatmedTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('matmeds', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_tmatmed')->unsigned();
            $table->foreign('id_tmatmed')->references('id')->on('tmatmeds');

            $table->integer('id_fabricante')->unsigned()->nullable();
            $table->foreign('id_fabricante')->references('id')->on('fabricantes');

            $table->string('codigo_fabricante', 8)->nullable();
            $table->string('nome_fabricante', 100)->nullable();

            $table->string('codigo_matmed', 10)->nullable();
            $table->string('codigo_matmed_fracionado', 10)->nullable();

            $table->string('nome_matmed', 100)->nullable();
            $table->string('codigo_apresentacao', 8)->nullable();
            $table->string('nome_apresentacao', 200)->nullable();

            $table->double('preco', 12, 2)->nullable();
            $table->double('preco_fabrica', 12, 2)->nullable();

            $table->double('preco_fracionado', 12, 2)->nullable();
            $table->double('preco_fabrica_fracionado', 12, 2)->nullable();

            $table->double('quantidade', 12, 2)->nullable();
            $table->string('edicao_brasindice', 5)->nullable();
            $table->double('ipi', 12, 2)->nullable();
            $table->string('portaria_piscofins', 15)->nullable();
            $table->string('codigo_tiss', 10)->nullable();
            $table->string('codigo_tuss', 8)->nullable();
            $table->string('codigo_barras', 20)->nullable();
            $table->string('codigo_reg_anvisa', 20)->nullable();
            $table->string('data_validade_reg_anvisa', 13)->nullable();

            $table->string('tipo_embalagem', 5)->nullable();

            $table->enum('uso_hospitalar', array('S', 'N'))->nullable();
            $table->string('fracionado', 1)->nullable();
            $table->string('diversos', 1)->nullable();
             $table->string('generico', 1)->nullable();
            $table->enum('tipo', array('SO', 'MA', 'ME'))->nullable(); //Soluçao Material Medicamento
            $table->enum('tabela', array('S', 'B'))->nullable(); //SIMPRO BRASINDICE
            $table->enum('status', array('A', 'I'))->nullable();

            $table->string('simpro_codigo_mercado', 2)->nullable();
            /*Código do Mercado:
            (20)Material Hospitalar 
            (50)Medicamentos 
            (90)Reagentes
            (30)Saneantes
             */
            $table->enum('simpro_identificacao', array('F', 'V', 'L', 'A', 'D'))->nullable();
            /*
              Identificação:
              (F) Preço Fábrica
              (V) Preço Venda
              (L) Fora de Linha
              (A) Atualização Suspensa
              (D) Descontinuado
             */

            $table->string('simpro_data_vigencia', 8)->nullable();
              
            $table->double('simpro_quantidade_embalagem', 12, 2)->nullable();
            $table->double('simpro_quantidade_fracao_usuario', 12, 2)->nullable();
            $table->double('simpro_percentual_lucro_usuario', 12, 2)->nullable();
            
            $table->double('simpro_percentual_desconto', 12, 2)->nullable();
            $table->double('simpro_preco_fabr_embalagem', 12, 2)->nullable();
            $table->double('simpro_preco_vend_embalagem', 12, 2)->nullable();
            $table->double('simpro_preco_usuario_embalagem', 12, 2)->nullable();

            $table->double('simpro_preco_fabr_fracao', 12, 3)->nullable();
            $table->double('simpro_preco_vend_fracao', 12, 3)->nullable();
            $table->double('simpro_preco_usuario_fracao', 12, 3)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('matmeds');
    }

}
