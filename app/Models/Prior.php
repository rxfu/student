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
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $course 8位课程号
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeFailed($query, $course, $user) {
		return $query->join('cj_zxscj', 'cj_zxscj.kch', '=', 'jx_kc_qxgx.kch')
			->where('cj_zxscj.xh', '=', $user->xh)
			->where('cj_zxscj.xf', '<=', 0)
			->where('kch2', '=', $course)
			->where('gx', '=', '>');
	}
}
