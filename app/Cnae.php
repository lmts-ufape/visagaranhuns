<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cnae extends Model
{
    protected $table = 'cnaes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'descricao', 'areas_id',
    ];

    public function area() {
        return $this->belongsTo("\App\Area");
    }

    public function empresa() {
        return $this->belongsToMany("\App\Empresa");
    }
}
