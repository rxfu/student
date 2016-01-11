<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model {

	protected $table = 'zd_xsh';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xsh', 'dm');
	}
}
