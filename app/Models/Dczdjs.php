<?php

namespace App\Models;

/**
 * 大创项目指导教师
 *
 * @author FuRongxin
 * @date 2017-12-04
 * @version 2.3
 */
class Dczdjs extends DcxmModel {

	protected $table = 'dc_zdjs';

	protected $primaryKey = 'id';

	public $timestamps = false;

	/**
	 * 项目信息
	 * @author FuRongxin
	 * @date    2017-12-04
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function projects() {
		return $this->belongsTo('App\Models\Dcxmxx', 'xm_id', 'id');
	}

	/**
	 * 教师资料
	 * @author FuRongxin
	 * @date    2017-12-21
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function teacher() {
		return $this->belongsTo('App\Models\Teacher', 'jsgh', 'jsgh');
	}

	/**
	 * 扩展查询：判断是否本校教师
	 * @author FuRongxin
	 * @date    2018-01-28
	 * @version 2.3
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   boolean $flag 是否本校教师，true为是，false为否
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeInSchool($query, $flag) {
		return $query->whereSfbx($flag);
	}
}
