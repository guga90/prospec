<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_procedimento',
        'id_especialidade',
        'info'
    ];

}