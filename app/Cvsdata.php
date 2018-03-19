<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cvsdata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    		'citycode', 'userid', 'conversationid', 'dnode', 'time',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey =['citycode','userid'];
    public $incrementing = FALSE;
    protected $table = 'cvsdata';
}
