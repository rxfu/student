<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 考试状态
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class Exstatus extends Model {

	protected $table = 'cj_kszt';

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
		return $this->hasMany('App\Models\Score', 'kszt', 'dm');
	}
}
