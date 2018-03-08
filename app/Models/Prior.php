<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 前修关系
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class Prior extends Model {

	protected $table = 'jx_kc_qxgx';

	protected $primaryKey = 'kch';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 扩展查询，获取不及格的前修课程
	 * 2018-3-8：应教务处要求，前修课检测逻辑为：前修课已选课即可，不论是否及格。此函数不用，改用scopeIsStudied函数
	 * @author FuRongxin
	 * @date    2017-01-03
	 * @version 2.1.3
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $course 8位课程号
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeFailed($query, $course, $user) {

		// kch：当前选修课程号
		// kch2：前修课课程号
		return $query->join('cj_zxscj', 'cj_zxscj.kch', '=', 'jx_kc_qxgx.kch2')
			->where('cj_zxscj.xh', '=', $user->xh)
			->where('cj_zxscj.xf', '<=', 0)
			->where('jx_kc_qxgx.kch', '=', $course)
			->where('gx', '=', '>');
	}

	/**
	 * 扩展查询，获取已修读的前修课程
	 * @author FuRongxin
	 * @date    2018-03-08
	 * @version 2.3
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $course 8位课程号
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeStudied($query, $course, $user) {

		// kch：当前选修课程号
		// kch2：前修课课程号
		return $query->where('jx_kc_qxgx.kch', '=', $course)
			->where('gx', '=', '>')
			->join('xk_xkxx', 'xk_xkxx.kch', '=', 'jx_kc_qxgx.kch2')
			->where('xk_xkxx.xh', '=', $user->xh)
			->where(function ($query) {
				$query->where('xk_xkxx.nd', '<>', session('year'))
					->orWhere('xk_xkxx.xq', '<>', session('term'));
			});
	}
}
