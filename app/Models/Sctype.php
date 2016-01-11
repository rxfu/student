<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sctype extends Model {

	protected $table = 'zd_bxlx';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'bxlx', 'dm');
	}
}
