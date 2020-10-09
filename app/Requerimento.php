<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimento extends Model
{
    protected $table = 'requerimentos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'status', 'aviso', 'cnae_id', 'data', 'resptecnicos_id', 'empresas_id',
    ];

    // Cnae especifico para o requerimento
    public function cnae() {
        return $this->belongsTo("\App\Cnae");
    }

    // Responsável Técnico que requisitou o requerimento
    public function resptecnico() {
        return $this->belongsTo("\App\RespTecnico",'resptecnicos_id');
    }

    // Requerimento de uma empresa
    public function empresa() {
        return $this->belongsTo("\App\Empresa",'empresas_id');
    }
}
