<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    		'citycode', 'code1', 'code2', 'meisho', 'num', 'class1', 'class2',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey =['citycode','code1', 'code2'];
    public $incrementing = FALSE;
    protected $table = 'code';
}