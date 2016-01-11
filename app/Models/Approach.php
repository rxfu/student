<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approach extends Model {

	protected $table = 'zd_bxxs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'bxxs', 'dm');
	}
}
