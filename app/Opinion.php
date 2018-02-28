<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{


	//use CompositePrimaryKeyTrait;




	/*protected $fillable = [

	'citycode', 'no', 'time', 'sex', 'age', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];
	*/



	//protected $primaryKey =['citycode','id'];
	protected $primaryKey ='userid';
	public $incrementing = false;
	protected $table = 'opinion';

}
