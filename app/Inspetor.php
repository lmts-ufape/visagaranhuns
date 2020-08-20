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
        'formacao', 'especializacao', 'user_id',
    ];

    public function user() {
        return $this->belongsTo("\App\User");
    }
}
