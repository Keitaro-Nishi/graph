<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{




	protected $fillable = [

	'citycode','date','time','bunrui', 'gid1', 'gid2', 'gid3', 'meisho',

	];


	protected $primaryKey = ['gid1', 'gid2','gid3'];
	public $incrementing = false;
	public $timestamps = false;
	protected $table = 'event';

}
