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
        'data', 'inspetor_id',
    ];

    public function agente() {
        return $this->belongsToMany("\App\Agente");
    }

    public function requerimento() {
        return $this->hasMany("\App\Requerimento");
    }
}
