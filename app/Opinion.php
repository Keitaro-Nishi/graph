<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{


	/*protected $fillable = [

	'citycode', 'no', 'time', 'sex', 'age', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];
	*/

	protected $primaryKey =['citycode','id'];
	//protected $primaryKey ='id';
	protected $table = 'opinion';
	public $timestamps = false;
}
