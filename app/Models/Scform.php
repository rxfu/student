<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学习形式
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Scform extends Model {

	protected $table = 'zd_xxxs';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xxxs', 'dm');
	}
}
