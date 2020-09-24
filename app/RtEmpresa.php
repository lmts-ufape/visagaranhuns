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
        'resptec_id', 'empresa_id', 'area_id', 'horas', 'data_inicio', 'status'
    ];

    public function resptecnico() {
        return $this->belongsTo("\App\RespTecnico");
    }

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
