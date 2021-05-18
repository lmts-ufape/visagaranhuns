<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspecao extends Model
{
    protected $table = 'inspecoes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data', 'status', 'motivo', 'inspetor_id', 'requerimento_id', 'empresas_id', 'denuncias_id'
    ];

    public function agentes() {
        return $this->belongsToMany("\App\Agente", 'inspec_agente', 'inspecoes_id', 'agente_id');
    }

    public function inspetor() {
        return $this->belongsTo("\App\Inspetor");
    }

    public function requerimento() {
        return $this->belongsTo("\App\Requerimento");
    }

    public function empresa() {
        return $this->belongsTo("\App\Empresa", 'empresas_id');
    }

    public function denuncia() {
        return $this->belongsTo("\App\Denuncia", 'denuncias_id');
    }

    public function relatorio() {
        return $this->hasOne("\App\InspecaoRelatorio", 'inspecao_id');
    }

    public function notificacoes() {
        return $this->hasMany("\App\Notificacao", 'inspecoes_id');
    }
}
