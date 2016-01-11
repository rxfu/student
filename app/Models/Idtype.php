<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idtype extends Model {

	protected $table = 'zd_zjlx';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zjlx', 'dm');
	}
}
