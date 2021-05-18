<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InspecAgente extends Pivot
{
    protected $table = 'inspec_agente';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = true;
}
