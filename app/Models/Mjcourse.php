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
		return $this->hasMany('App\Models\Timetable', 'kcxh', 'kcxh')
			->whereNd($this->nd)
			->whereXq($this->xq);
	}

	public function scopeSelectable($query, $type) {
		return $query->with([
			'campus'             => function ($query) {
				$query->select('dm', 'mc');
			},
			'teacher'            => function ($query) {
				$query->select('jsgh', 'xm', 'zc');
			},
			'task.course'        => function ($query) {
				$query->select('kch', 'kcmc');
			},
			'mjcourse.plan'      => function ($query) {
				$query->whereZy(session('major'))
					->select('zy', 'zxf', 'kh');
			},
			'mjcourse.plan.mode' => function ($query) {
				$query->select('dm', 'mc');
			},
			'mjcourse'           => function ($query) use ($type) {
				$query = $query->select('kcxh', 'rs');

				switch ($type) {
				case 'public':
					$query->wherePt('T')
						->whereXz('B')
						->whereNj(session('grade'))
						->whereZy(session('major'));
					break;

				case 'require':
					$query->whereXz('B')
						->whereNj(session('grade'))
						->whereZy(session('major'));
					break;

				case 'elect':
					$query->whereXz('X')
						->whereNj(session('grade'))
						->whereZy(session('major'));
					break;

				case 'human':
					$query->wherePt('T')
						->whereXz('W')
						->whereNj(session('grade'))
						->whereZy(session('major'));

				case 'nature':
					$query->wherePt('T')
						->whereXz('I')
						->whereNj(session('grade'))
						->whereZy(session('major'));

				case 'art':
					$query->wherePt('T')
						->whereXz('Y')
						->whereNj(session('grade'))
						->whereZy(session('major'));

				case 'other':
					$query->wherePt('T')
						->whereXz('Q')
						->whereNj(session('grade'))
						->whereZy(session('major'));
					break;

				default:
					break;
				}
			},
			'selcount',
		])
			->whereNd(session('year'))
			->whereXq(session('term'));
	}

}
