<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 教师
 *
 * @author FuRongxin
 * @date 2016-02-15
 * @version 2.0
 */
class Teacher extends Model {

	protected $table = 'pk_js';

	protected $primaryKey = 'jsgh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 排课表
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function timetables() {
		return $this->hasMany('App\Models\Timetable', 'jsgh', 'jsgh');
	}

	/**
	 * 职称
	 * @author FuRongxin
	 * @date    2016-02-16
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function position() {
		return $this->belongsTo('App\Models\Position', 'zc', 'dm');
	}

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function department() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}
}
