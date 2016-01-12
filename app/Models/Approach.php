<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 办学形式
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Approach extends Model {

	protected $table = 'zd_bxxs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'bxxs', 'dm');
	}
}
