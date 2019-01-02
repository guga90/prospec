<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tprocedimento',
        'name',
        'codigo',
        'valor',
        'status'
    ];

}
