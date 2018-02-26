<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [

			'citycode', 'id', 'meisho', 'jusho', 'tel', 'genre1', 'genre2', 'genre3', 'lat',
			'lng', 'imageurl', 'url', 'geom',

	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */

	protected $primaryKey = ['citycode', 'no'];
	public $incrementing = FALSE;
	protected $table = 'facility';
}