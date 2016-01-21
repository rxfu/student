<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 课程平台
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class Platform extends Model {

	protected $table = 'zd_pt';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 教学计划
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function plans() {
		return $this->hasMany('App\Models\Plan', 'pt', 'dm');
	}

	/**
	 * 毕业要求
	 * @author FuRongxin
	 * @date    2016-01-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function requirements() {
		return $this->hasMany('App\Models\Requirement', 'pt', 'dm');
	}
}
