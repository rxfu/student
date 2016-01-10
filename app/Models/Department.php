<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	protected $table = 'xt_department';

	protected $primaryKey = 'dw';

	public $incrementing = false;

	public $timestatmps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xy', 'dw');
	}

}
