<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 入学方式
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Entrance extends Model {

	protected $table = 'zd_rxfs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'rxfs', 'dm');
	}
}
