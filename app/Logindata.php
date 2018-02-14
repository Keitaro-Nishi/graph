<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Logindata extends Model
{



	protected $fillable = [

			'id', 'userid','last_login_at','last_logout_at'

	];


	protected $table = 'logindata';

}
