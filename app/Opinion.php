<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Opinion extends Model
{



	protected $fillable = [

	'citycode', 'no','time','sex','age', 'opinion','sadness','joy','fear', 'disgust','anger','checked'

	];


	protected $table = 'opinion';

}
