<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncias';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'nome', 'email', 'telefone', 'denuncia', 'status', 'empresa_id'
        'empresa', 'endereco', 'status', 'denuncia', 'empresa_id',
    ];

    public function empresaRelacionamento() {
        return $this->belongsTo("\App\Empresa", 'empresa_id');
    }
}
