<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tipo',
        'status'
    ];

}
