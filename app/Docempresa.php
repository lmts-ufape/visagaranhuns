<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docempresa extends Model
{
    protected $table = 'docs_empresa';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'area', 'data_emissao', 'data_validade', 'empresa_id', 'tipodocemp_id', 
    ];

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }

    // Tipo de documento da empresa
    public function tipodocemp() {
        return $this->belongsTo("\App\Tipodocempresa", 'tipodocemp_id');
    }
}
