<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * 专业课程信息
 *
 * @author FuRongxin
 * @date 2016-01-29
 * @version 2.0
 */
class Mjcourse extends Model {

	protected $table = 'pk_kczy';

	protected $primaryKey = 'kcxh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'xz', 'dm');
	}

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function task() {
		return $this->belongsTo('App\Models\Task', 'kcxh', 'kcxh')
			->whereNd($this->nd)
			->whereXq($this->xq);
	}

	/**
	 * 教学计划
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function plan() {
		return $this->belongsTo('App\Models\Plan', 'zy', 'zy')
			->whereNj($this->nj)
			->whereZsjj($this->zsjj)
			->whereKch(Str::substr($this->kcxh, 2, 8));
	}

	/**
	 * 课程表
	 * @author FuRongxin
	 * @date    2016-02-24
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function timetables() {
		return $this->hasMany('App\Models\Timetable', 'kcxh', 'kcxh');
	}

	public function scopeOfType($query, $type) {
		switch ($type) {
		case 'public':
			return $query->wherePt('T')
				->whereXz('B')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'require':
			return $query->whereXz('B')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'elect':
			return $query->whereXz('X')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'human':
			return $query->wherePt('T')
				->whereXz('W')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'nature':
			return $query->wherePt('T')
				->whereXz('I')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'art':
			return $query->wherePt('T')
				->whereXz('Y')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		case 'other':
			return $query->wherePt('T')
				->whereXz('Q')
				->whereNj(session('grade'))
				->whereZy(session('major'));

		default:
			break;
		}
	}

	public function scopeSelectable($query) {
		return $query->with([
			'plan'               => function ($query) {
				$query->select('zy', 'zxf', 'kh');
			},
			'plan.course'        => function ($query) {
				$query->select('kch', 'kcmc');
			},
			'plan.mode'          => function ($query) {
				$query->select('dm', 'mc');
			},
			'timetables'         => function ($query) {
				$query->whereNd(session('year'))
					->whereXq(session('term'));
			},
			'timetables.teacher' => function ($query) {
				$query->select('jsgh', 'xm');
			},
		])
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereZsjj(session('season'));
	}

}
