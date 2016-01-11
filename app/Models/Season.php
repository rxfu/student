<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model {

	protected $table = 'zd_zsjj';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zsjj', 'dm');
	}
}
