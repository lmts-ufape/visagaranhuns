<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table = 'agente';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formacao', 'especializacao', 'cpf', 'telefone', 'user_id',
    ];

    public function user() {
        return $this->belongsTo("\App\User", 'user_id');
    }

    public function inspecao() {
        return $this->belongsToMany("\App\Inspecao", 'inspec_agente', 'agente_id', 'inspecao_id');
    }
}
