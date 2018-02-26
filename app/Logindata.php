<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Logindata extends Model
{

	protected $fillable = [

			'citycode', 'id', 'userid', 'classification', 'time'

	];

	protected $table = 'logindata';
	public $timestamps = false;
}
