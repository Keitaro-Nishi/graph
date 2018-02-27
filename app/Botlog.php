<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botlog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    		'citycode', 'no', 'time', 'sender', 'type', 'userid', 'contents', 'return',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $primaryKey ='no';
    public $incrementing = FALSE;
    protected $table = 'botlog';
}