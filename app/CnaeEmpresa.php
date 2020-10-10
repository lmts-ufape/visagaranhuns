<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CnaeEmpresa extends Model
{
    protected $table = 'cnaes_empresas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id', 'cnae_id',
    ];

    public function cnae() {
        return $this->belongsTo("\App\Cnae");
    }

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
    public function requerimento() {
        return $this->belongsTo("\App\Requerimento",'cnae_id');
    }
}
