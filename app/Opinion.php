<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{


	protected $fillable = [

	'citycode', 'id','userid','time', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];

	protected $table = 'opinion';
	public $timestamps = false;
}
