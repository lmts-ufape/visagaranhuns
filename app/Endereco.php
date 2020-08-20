<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rua', 'numero', 'bairro', 'cidade', 'uf', 'cep', 'complemento', 'empresa_id',
    ];

    public function empresa() {
        return $this->belongsTo("\App\Empresa");
    }
}
