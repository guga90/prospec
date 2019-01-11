<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsEnvios extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_client',
        'id_sms_campanha',
        'log',
        'name',
        'status'
    ];

}
