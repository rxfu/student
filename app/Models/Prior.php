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
	 * 扩展查询，获取前修课程
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $course 8位课程号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfCourse($query, $course) {
		return $query->whereKch2($course)
			->whereGx('>')
			->select('kch');
	}
}
