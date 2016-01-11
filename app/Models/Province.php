<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {

	protected $table = 'zd_syszd';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'syszd', 'dm');
	}
}
