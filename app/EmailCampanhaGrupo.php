<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampanhaGrupo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_email_campanha',
        'id_grupo'
    ];

}
