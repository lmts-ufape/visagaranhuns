<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspetor extends Model
{
    protected $table = 'inspetor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formacao', 'especializacao', 'cpf', 'telefone', 'user_id',
    ];

    public function user() {
        return $this->belongsTo("\App\User");
    }

    public function inspecao() {
        return $this->hasMany("\App\Inspecao");
    }
}
