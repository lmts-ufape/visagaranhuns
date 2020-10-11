<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklistresp extends Model
{
    protected $table = 'checklistresp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anexado', 'areas_id', 'nomeDoc', 'tipodocres_id', 'resptecnicos_id',
    ];

    // Areas
    public function area() {
        return $this->belongsTo("\App\Area");
    }
    // Tipos de documentos de responsável técnico
    public function tipodocres() {
        return $this->belongsTo("\App\Tipodocresp");
    }

    public function resptecnico() {
        return $this->belongsTo("\App\RespTecnico");
    }
}
