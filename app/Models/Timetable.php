<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 排课表
 *
 * @author FuRongxin
 * @date 2016-02-15
 * @version 2.0
 */
class Timetable extends Model {

	protected $table = 'pk_kb';

	protected $primaryKey = 'kcxh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 *  选课信息
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function selcourse() {
		return $this->belongsTo('App\Models\Selcourse', 'kcxh', 'kcxh');
	}

	/**
	 * 校区
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function campus() {
		return $this->belongsTo('App\Models\Campus', 'xqh', 'dm');
	}

	/**
	 * 教室
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function classroom() {
		return $this->belongsTo('App\Models\Classroom', 'cdbh', 'jsh');
	}

	/**
	 * 教师
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function teacher() {
		return $this->belongsTo('App\Models\Teacher', 'jsgh', 'jsgh');
	}

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-02-24
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function task() {
		return $this->belongsTo('App\Models\Task', 'kxch', 'kxch')
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereId(1);
	}

	/**
	 * 已选人数统计
	 * @author FuRongxin
	 * @date    2016-02-24
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function selcount() {
		return $this->hasOne('App\Models\Count', 'kcxh', 'kcxh');
	}

	public function scopeSelectable($query) {
		return $query->with([
			'campus'      => function ($query) {
				$query->select('dm', 'mc');
			},
			'teacher'     => function ($query) {
				$query->select('jsgh', 'xm', 'zc');
			},
			'task.course' => function ($query) {
				$query->select('kch', 'kcmc');
			},
			'selcount',
		])
			->whereNd(session('year'))
			->whereXq(session('term'));
	}

}
