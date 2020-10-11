<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklistemp extends Model
{
    protected $table = 'checklistemp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anexado', 'areas_id', 'nomeDoc', 'tipodocemp_id', 'empresa_id',
    ];

    // Areas
    public function area() {
        return $this->belongsTo("\App\Area");
    }
    // Tipos de documentos de empresa
    public function tipodocemp() {
        return $this->belongsTo("\App\Tipodocempresa");
    }

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
