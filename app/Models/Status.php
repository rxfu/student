<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学籍状态
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Status extends Model {

	protected $table = 'zd_xjzt';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xjzt', 'dm');
	}
}
