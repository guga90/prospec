<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kitmatmed extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kit',
        'id_matmed',
        'quantidade'
    ];

}
