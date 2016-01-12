<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 政治面貌
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Party extends Model {

	protected $table = 'zd_zzmm';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zzmm', 'dm');
	}
}
