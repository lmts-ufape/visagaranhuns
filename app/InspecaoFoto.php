<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspecaoFoto extends Model
{
    protected $table = 'inspecao_fotos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inspecao_id', 'descricao', 'imagemInspecao',
    ];
}
