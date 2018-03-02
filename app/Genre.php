<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{


	//use CompositePrimaryKeyTrait;

	public $test = ["テスト1","テスト2","テスト3","テスト4"];
	/*protected $fillable = [

	'citycode', 'no', 'time', 'sex', 'age', 'opinion', 'sadness', 'joy', 'fear', 'disgust', 'anger', 'checked'

	];
	*/

	//protected $primaryKey =['citycode','id'];
	protected $primaryKey = ['gid1', 'gid2','gid3'];
	public $incrementing = false;
	protected $table = 'genre';

}
