<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 补考成绩
 *
 * @author RuRongxin
 * @date 2016-01-28
 * @version 2.0
 */
class Muscore extends Model {

	protected $table = 'cj_bkcj';

	protected $primaryKey = 'xh';

	public $incremeting = false;

	public $timestamps = false;

	/**
	 * 学期
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function term() {
		return $this->belongsTo('App\Models\Term', 'xq', 'dm');
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'kcpt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'kcxz', 'dm');
	}

	/**
	 * 考核方式
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function mode() {
		return $this->belongsTo('App\Models\Mode', 'kh', 'dm');
	}

	/**
	 * 考试状态
	 * @author FuRongxin
	 * @date    2016-01-28
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
	 * 扩展查询，用于获取学生综合成绩对应的补考成绩
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @param   string $kch 8位课程号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeMakeupScore($query, $user, $kch) {
		$lstKcxh = Task::whereKch($kch)
			->distinct('kcxh')
			->pluck('kcxh');

		// 提交状态为3的成绩方可显示
		return $query->whereXh($user->xh)
			->whereIn('kcxh', $lstKcxh)
			->whereTjzt(config('constants.score.dconfirmed'));
	}
}
