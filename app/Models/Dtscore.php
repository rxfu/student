<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

/**
 * 学生过程成绩
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class Dtscore extends Model {

	protected $table = 'cj_lscj';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学期
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function term() {
		return $this->belongsTo('App\Models\Term', 'xq', 'dm');
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'kcpt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'kcxz', 'dm');
	}

	/**
	 * 考核方式
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function mode() {
		return $this->belongsTo('App\Models\Mode', 'kh', 'dm');
	}

	/**
	 * 考试状态
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function exstatus() {
		return $this->belongsTo('App\Models\Exstatus', 'kszt', 'dm');
	}

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function task() {
		return $this->belongsTo('App\Models\Task', 'kcxh', 'kcxh')
			->whereNd($this->nd)
			->whereXq($this->xq);
	}

	/**
	 * 扩展查询，用于获取学生综合成绩对应的过程成绩
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @param   string $kch 8位课程号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeDetailScore($query, $user, $kch) {
		$lstKcxh = Task::whereKch($kch)
			->distinct('kcxh')
			->lists('kcxh');

		return $query->whereXh($user->xh)
			->whereIn('kcxh', $lstKcxh)
			->whereTjzt(config('constants.score.dconfirmed'));
	}
}
