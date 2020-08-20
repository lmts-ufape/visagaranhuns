<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocempresa extends Model
{
    protected $table = 'tipodocemp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'descricao', 'validade',
    ];

    // Documentos de empresa
    public function docsempresa() {
        return $this->hasMany("\App\Docempresa");
    }

    public function area() {
        return $this->belongsToMany("\App\Area");
    }
}
