<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Logindata extends Model
{
	use Notifiable;

	protected $fillable = [

			'id', 'userid','last_login_at','last_logout_at'

	];


	protected $table = 'logindata';
    //
}
