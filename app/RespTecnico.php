<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespTecnico extends Model
{
    protected $table = 'resptecnicos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formacao', 'especializacao', 'user_id', 'empresa_id'
    ];

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }

    public function user() {
        return $this->belongsTo("\App\User");
    }

}
