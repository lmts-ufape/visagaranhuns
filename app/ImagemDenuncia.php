<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagemDenuncia extends Model
{
    protected $table = 'imagens_denuncia';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'denuncias_id',
    ];

    public function denuncia() {
        return $this->belongsTo("\App\Denuncia", 'denuncias_id');
    }
}
