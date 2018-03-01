<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logimage extends Model
{

	//use CompositePrimaryKeyTrait;

	/*protected $fillable = [

	'citycode', 'no', 'time', 'sex', 'age', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];
	*/

	protected $primaryKey ='no';
	public $incrementing = true;
	protected $table = 'opinion';

}
