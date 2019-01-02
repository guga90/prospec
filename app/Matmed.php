<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matmed extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tmatmed',
        'id_fabricante',
        'codigo_fabricante',
        'nome_fabricante',
        'codigo_matmed',
        'codigo_matmed_fracionado',
        'nome_matmed',
        'codigo_apresentacao',
        'nome_apresentacao',
        'preco',
        'preco_fabrica',
        'preco_fracionado',
        'preco_fabrica_fracionado',
        'quantidade',
        'edicao_brasindice',
        'portaria_piscofins',
        'codigo_tiss',
        'codigo_tuss',
        'codigo_barras',
        'codigo_reg_anvisa',
        'data_validade_reg_anvisa',
        'tipo_embalagem',
        'uso_hospitalar',
        'fracionado',
        'diversos',
        'generico',
        'tipo',
        'tabela',
        'status',
        'simpro_codigo_mercado',
        'simpro_identificacao',
        'simpro_data_vigencia',
        'simpro_quantidade_embalagem',
        'simpro_quantidade_fracao_usuario',
        'simpro_percentual_lucro_usuario',
        'simpro_percentual_desconto',
        'simpro_preco_fabr_embalagem',
        'simpro_preco_vend_embalagem',
        'simpro_preco_usuario_embalagem',
        'simpro_preco_fabr_fracao',
        'simpro_preco_vend_fracao',
        'simpro_preco_usuario_fracao',
    ];

}
