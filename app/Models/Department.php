<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 单位
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class Department extends Model {

	protected $table = 'xt_department';

	protected $primaryKey = 'dw';

	public $incrementing = false;

	public $timestatmps = false;

	protected $connection = 'pgsql';

	/**
	 * 个人资料
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function profiles() {
		return $this->hasMany('App\Models\Profile', 'xy', 'dw');
	}

	/**
	 * 学院校区对应表
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function pivot() {
		return $this->hasOne('App\Models\Campuspivot', 'xy', 'dw');
	}

	/**
	 * 扩展查询，用于获取学院
	 * @author FuRongxin
	 * @date    2016-03-06
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeColleges($query) {
		return $query->whereLx(config('constants.department.college'))
			->whereZt(config('constants.status.enable'));
	}

	/**
	 * 教师
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function department() {
		return $this->belongsTo('App\Models\Teacher', 'xy', 'dw');
	}
}
