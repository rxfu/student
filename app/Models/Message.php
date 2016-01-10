<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $table = 'xt_message';

	public $incrementing = false;

	public $timestatmps = false;
}
