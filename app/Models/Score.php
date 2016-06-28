<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生成绩
 *
 * @author FuRongxin
 * @date 2016-01-23
 * @version 2.0
 */
class Score extends Model {

	protected $table = 'cj_zxscj';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学期
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function term() {
		return $this->belongsTo('App\Models\Term', 'xq', 'dm');
	}

	/**
	 * 课程
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function course() {
		return $this->belongsTo('App\Models\Course', 'kch', 'kch');
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'kcxz', 'dm');
	}

	/**
	 * 考核方式
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function mode() {
		return $this->belongsTo('App\Models\Mode', 'kh', 'dm');
	}

	/**
	 * 考试状态
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function exstatus() {
		return $this->belongsTo('App\Models\Exstatus', 'kszt', 'dm');
	}

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function task() {
		return $this->belongsTo('App\Models\Task', 'kch', 'kch');
	}

	/**
	 * 扩展查询，用于获取已修读学分
	 * @author FuRongxin
	 * @date    2016-01-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeStudiedCredits($query, $user) {
		return $query->whereXh($user->xh)
			->groupBy('pt', 'kcxz')
			->selectRaw('pt, kcxz, SUM(xf) AS xf');
	}
}
