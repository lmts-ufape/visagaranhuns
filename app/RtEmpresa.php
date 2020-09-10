<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtEmpresa extends Model
{
    protected $table = 'rtempresa';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resptec_id', 'empresa_id',
    ];

    public function resptecnico() {
        return $this->belongsTo("\App\RespTecnico");
    }

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
