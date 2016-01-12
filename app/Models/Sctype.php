<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 办学类型
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Sctype extends Model {

	protected $table = 'zd_bxlx';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'bxlx', 'dm');
	}
}
