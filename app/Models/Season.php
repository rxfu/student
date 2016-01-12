<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 招生季节
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Season extends Model {

	protected $table = 'zd_zsjj';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'zsjj', 'dm');
	}
}
