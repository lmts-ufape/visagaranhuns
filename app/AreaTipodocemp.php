<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaTipodocemp extends Model
{
    protected $table = 'areatipodocemps';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id', 'tipodocemp_id',
    ];

    public function area() {
        return $this->belongsTo("\App\Area");
    }
    
    public function tipodocemp() {
        return $this->belongsTo("\App\Tipodocempresa");
    }
}
