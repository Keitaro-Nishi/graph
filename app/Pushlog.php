<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pushlog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    		'citycode', 'no', 'line_cat', 'time', 'info', 'age', 'sex',
    		'param1', 'param2', 'param3', 'param4', 'param5', 'param6', 'param7', 'param8', 'param9', 'param10', 'target', 'type','contents','sender'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey ='no';
    //public $incrementing = FALSE;
    protected $table = 'pushlog';
}