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
}
