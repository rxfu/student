<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	protected $table = 'xs_zxs';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}
}
