<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model {

	protected $table = 'zd_rxfs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'rxfs', 'dm');
	}
}
