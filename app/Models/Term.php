<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学期
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class Term extends Model {

	protected $table = 'zd_xq';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学生成绩
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function scores() {
		return $this->hasMany('App\Models\Score', 'xq', 'dm');
	}
}
