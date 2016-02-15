<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 教室
 *
 * @author FuRongxin
 * @date 2016-02-15
 * @version 2.0
 */
class Classroom extends Model {

	protected $table = 'js_jsxx';

	protected $primaryKey = 'jsh';

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
		return $this->hasMany('App\Models\Timetable', 'cdbh', 'jsh');
	}
}
