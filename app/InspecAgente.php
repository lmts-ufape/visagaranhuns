<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspecAgente extends Model
{
    protected $table = 'inspec_agente';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inspecoes_id', 'agente_id',
    ];

    public function inspecao() {
        return $this->belongsTo("\App\Inspecao");
    }

    public function agente() {
        return $this->belongsTo("\App\Agente");
    }
}
