<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model {

	protected $table = 'zd_zzmm';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zzmm', 'dm');
	}
}
