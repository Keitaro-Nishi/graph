<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logimage extends Model
{

	//use CompositePrimaryKeyTrait;

	protected $fillable = [

	'citycode', 'no', 'time', 'userid',/* 'image', */'score', 'class'

	];

	protected $primaryKey ='no';
	public $incrementing = true;
	protected $table = 'logimage';

}
