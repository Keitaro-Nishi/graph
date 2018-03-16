<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    		'citycode','sender','userid','name','language','age','sex','param1','param2','param3','param4','param5',
    		'param6','param7','param8','param9','param10','sposi','search','updkbn','time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey = ['citycode','sender','userid'];
    public $incrementing = FALSE;
    protected $table = 'userinfo';
}