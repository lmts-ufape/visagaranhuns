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
        'telefone1', 'telefone2', 'empresa_id',
    ];

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
