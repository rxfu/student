<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scform extends Model {

	protected $table = 'zd_xxxs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xxxs', 'dm');
	}
}
