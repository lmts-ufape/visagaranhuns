<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocresp extends Model
{
    protected $table = 'tipodocresp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', 'validade',
    ];

    // Documentos do responsável técnico
    public function docsresp() {
        return $this->hasMany("\App\Docresptec");
    }

    public function area() {
        return $this->belongsToMany("\App\Area");
    }
}
