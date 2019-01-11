<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampanha extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'msg',
        'name',
        'status'
    ];

}
