<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model {

	protected $table = 'xt_message';

	public $incrementing = false;

	public $timestatmps = false;
}
