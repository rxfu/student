<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 性别
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Gender extends Model {

	protected $table = 'zd_xb';

	protected $primaryKey = 'dm';

	public $incremting = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xbdm', 'dm');
	}
}
