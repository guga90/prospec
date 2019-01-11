<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailEnvios extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_client',
        'id_email_campanha',
        'log',
        'name',
        'status'
    ];

}
