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
        'data', 'status', 'inspetor_id', 'requerimentos_id'
    ];

    public function agente() {
        return $this->belongsToMany("\App\Agente");
    }

    public function inspetor() {
        return $this->belongsTo("\App\Inspetor");
    }

    public function requerimento() {
        return $this->belongsTo("\App\Requerimento");
    }
}
