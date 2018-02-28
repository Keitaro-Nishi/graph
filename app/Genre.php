<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{


	//use CompositePrimaryKeyTrait;




	/*protected $fillable = [

	'citycode', 'no', 'time', 'sex', 'age', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];
	*/



	//protected $primaryKey =['citycode','id'];
	protected $primaryKey = ['git1', 'git2','git3'];
	public $incrementing = false;
	protected $table = 'genre';

}
