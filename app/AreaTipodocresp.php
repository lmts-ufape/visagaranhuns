<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaTipodocresp extends Model
{
    protected $table = 'areatipodocresp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_id', 'tipodocresp_id',
    ];

    public function area() {
        return $this->belongsTo("\App\Area");
    }
    
    public function tipodocresp() {
        return $this->belongsTo("\App\Tipodocresp");
    }
}
