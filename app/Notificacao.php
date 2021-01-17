<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'item', 'exigencia', 'prazo', 'inspecoes_id'
    ];

    public function inspecao() {
        return $this->belongsTo("\App\Inspecao", 'inspecoes_id');
    }
}