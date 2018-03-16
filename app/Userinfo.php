<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{




	protected $fillable = [

	'citycode', 'sender', 'userid', 'name', 'language', 'age','sex','param1','param2','param3','param4','param5','param6',
	'param7','param8','param9','param10','sposi','search','updkbn',

	];

	protected $primaryKey = ['citycode', 'sender','userid'];
	public $incrementing = false;
	protected $table = 'userinfo';

}
