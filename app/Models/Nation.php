<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 民族
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Nation extends Model {

	protected $table = 'zd_mz';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'mzdm', 'dm');
	}
}
