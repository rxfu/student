<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 考核方式
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class Mode extends Model {

	protected $table = 'zd_khfs';

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
		return $this->hasMany('App\Models\Mode', 'kh', 'dm');
	}
}
