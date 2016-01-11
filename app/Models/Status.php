<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	protected $table = 'zd_xjzt';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xjzt', 'dm');
	}
}
