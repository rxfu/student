<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsfield extends Model {

	protected $table = 'zd_zylb';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zylb', 'dm');
	}
}
