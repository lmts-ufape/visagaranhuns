<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secao extends Model
{
    protected $table = 'secaos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo','posicao','descricao','servico_id',
    ];
}
