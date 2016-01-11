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

	public function major() {
		return $this->belongsTo('App\Models\Major', 'zy', 'zy');
	}

	public function secondary() {
		return $this->belongsTo('App\Models\Major', 'zy2', 'zy');
	}

	public function minor() {
		return $this->belongsTo('App\Models\Major', 'fxzy', 'zy');
	}

	public function gender() {
		return $this->belongsTo('App\Models\Gender', 'xbdm', 'dm');
	}

	public function idtype() {
		return $this->belongsTo('App\Models\Idtype', 'zjlx', 'dm');
	}

	public function country() {
		return $this->belongsTo('App\Models\Country', 'gj', 'dm');
	}

	public function nation() {
		return $this->belongsTo('App\Models\Nation', 'mzdm', 'dm');
	}

	public function party() {
		return $this->belongsTo('App\Models\Party', 'zzmm', 'dm');
	}

	public function province() {
		return $this->belongsTo('App\Models\Province', 'syszd', 'dm');
	}

	public function school() {
		return $this->belongsTo('App\Models\School', 'xsh', 'dm');
	}

	public function approach() {
		return $this->belongsTo('App\Models\Approach', 'bxxs', 'dm');
	}

	public function sctype() {
		return $this->belongsTo('App\Models\Sctype', 'bxlx', 'dm');
	}

	public function scform() {
		return $this->belongsTo('App\Models\Scform', 'xxxs', 'dm');
	}

	public function season() {
		return $this->belongsTo('App\Models\Season', 'zsjj', 'dm');
	}

}
