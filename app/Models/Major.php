<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model {

	protected $table = 'jx_zy';

	protected $primaryKey = 'zy';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zy', 'zy');
	}

	public function secondary_profiles() {
		return $this->hasMany('App\Models\Profile', 'zy2', 'zy');
	}

	public function minor_profiles() {
		return $this->hasMany('App\Models\Profile', 'fxzy', 'zy');
	}
}
