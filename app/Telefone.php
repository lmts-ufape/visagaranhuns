<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'telefones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'empresa_id',
    ];

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
