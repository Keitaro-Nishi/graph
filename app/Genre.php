<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{




	protected $fillable = [

	'citycode', 'bunrui', 'gid1', 'gid2', 'gid3', 'meisho',

	];

	//protected $primaryKey =['citycode','id'];
	protected $primaryKey = ['gid1', 'gid2','gid3'];
	public $incrementing = false;
	protected $table = 'genre';

}
