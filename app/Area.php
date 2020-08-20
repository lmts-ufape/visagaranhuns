<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
    ];

    // Tipos de documentos de empresa
    public function tipodocemp() {
        return $this->hasMany("\App\Tipodocempresa");
    }
    // Tipos de documentos do Responsável Técnico
    public function tipodocresp() {
        return $this->hasMany("\App\Tipodocresp");
    }

    public function cnae() {
        return $this->hasMany("\App\Cnae");
    }
}
