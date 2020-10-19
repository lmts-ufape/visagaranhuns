<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspecRequerimento extends Model
{
    protected $table = 'inspec_requerimento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inspecoes_id', 'requerimentos_id',
    ];

    public function inspecao() {
        return $this->belongsTo("\App\Inspecao");
    }

    public function requerimento() {
        return $this->belongsTo("\App\Requerimento");
    }

}
