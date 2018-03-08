<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    		'citycode', 'cityname', 'line_cat', 'cvs_ws_id1', 'cvs_ws_id2', 'cvs_ws_id3', 'cvs_ws_id4', 'cvs_ws_id5', 'intpasscalss', 'intpass'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey =['citycode'];
    public $incrementing = FALSE;
    protected $table = 'parameter';
}