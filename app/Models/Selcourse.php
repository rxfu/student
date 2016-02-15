<?php

namespace App\Models;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

/**
 * 选课信息
 *
 * @author FuRongxin
 * @date 2016-01-21
 * @version 2.0
 */
class Selcourse extends Model {

	protected $table = 'xk_xkxx';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 课程
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function course() {
		return $this->belongsTo('App\Models\Course', 'kch', 'kch');
	}

	/**
	 * 排课表
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function timetables() {
		return $this->hasMany('App\Models\Timetable', 'kcxh', 'kcxh')
			->whereNd(Setting::find('XK_ND')->value)
			->whereXq(Setting::find('XK_XQ')->value);
	}

	/**
	 * 扩展查询，用于获取已选课程学分
	 * @author FuRongxin
	 * @date    2016-01-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectedCredits($query, $user) {
		return $query->whereNd(Setting::find('XK_ND')->value)
			->whereXq(Setting::find('XK_XQ')->value)
			->whereXh($user->xh)
			->groupBy('pt', 'xz')
			->selectRaw('pt, xz, SUM(xf) AS xf');
	}

}
