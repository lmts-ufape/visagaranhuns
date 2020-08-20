<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table = 'agentes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formacao', 'user_id',
    ];

    public function user() {
        return $this->belongsTo("\App\User");
    }
}
