<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 职称
 *
 * @author FuRongxin
 * @date 2016-02-16
 * @version 2.0
 */
class Position extends Model {

	protected $table = 'zd_zc';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 教师信息
	 * @author FuRongxin
	 * @date    2016-02-16
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function teachers() {
		return $this->hasMany('App\Models\Teacher', 'zc', 'dm');
	}
}
