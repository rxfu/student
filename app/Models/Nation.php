<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model {

	protected $table = 'zd_mz';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'mzdm', 'dm');
	}
}
