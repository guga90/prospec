<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'telefone',
        'info',
        'status'
    ];

}
