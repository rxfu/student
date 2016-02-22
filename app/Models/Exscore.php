<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 国家考试成绩单
 *
 * @author FuRongxin
 * @date 2016-01-28
 * @version 2.0
 */
class Exscore extends Model {

	protected $table = 'cj_qtkscj';

	protected $primaryKey = 'c_xh';

	public $incremeting = false;

	public $timestamps = false;

	/**
	 * 考试类型
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function type() {
		return $this->belongsTo('App\Models\Extype', 'c_kslx', 'kslx');
	}

	/**
	 * 扩展查询，用于检测学生考试成绩是否及格
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @param   array $exams 考试类型数组
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeIsPassed($query, $user, $exams) {
		return $query->whereC_xh($user->xh)
			->whereIn('c_kslx', $exams)
			->whereRaw('c_cj >= (SELECT jgx FROM t_cj_kslxdm WHERE c_kslx = kslx)');
	}
}
