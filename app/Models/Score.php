<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生成绩
 *
 * @author FuRongxin
 * @date 2016-01-23
 * @version 2.00
 */
class Score extends Model {

	protected $table = 'cj_zxscj';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

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
			->selectRaw('pt, kcxz AS xz, SUM(xf) AS xf');
	}
}
