<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'name',
        'name_marca',
        'status'
    ];

}
