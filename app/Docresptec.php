<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docresptec extends Model
{
    protected $table = 'docs_responsavel';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'data_emissao', 'data_validade', 'resptecnicos_id', 'tipodocresp_id',
    ];

    public function resptecnico() {
        return $this->belongsTo("\App\RespTecnico");
    }

    // Tipo de documento do responsável técnico
    public function tipodocresp() {
        return $this->belongsTo("\App\Tipodocresp");
    }
}
