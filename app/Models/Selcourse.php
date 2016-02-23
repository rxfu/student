<?php

namespace App\Models;

use App\Models\Count;
use App\Models\Slog;
use Illuminate\Database\Eloquent\Model;

/**
 * 选课信息
 *
 * @author FuRongxin
 * @date 2016-01-21
 * @version 2.0
 */
class Selcourse extends Model {

	protected $table = 'xk_xkxx';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	public static function boot() {
		parent::boot();

		static::created(function ($course) {
			$count = Count::find($course->kcxh);
			$count->rs += 1;
			$count->save();

			$log       = new Slog;
			$log->ip   = request()->ip();
			$log->czlx = 'insert';
			$log->save();
		});

		static::deleted(function ($course) {
			$count = Count::find($course->kcxh);
			$count->rs -= 1;
			$count->save();

			$log       = new Slog;
			$log->ip   = request()->ip();
			$log->czlx = 'delete';
			$log->save();
		});
	}

	/**
	 * 课程
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function course() {
		return $this->belongsTo('App\Models\Course', 'kch', 'kch');
	}

	/**
	 * 排课表
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function timetables() {
		return $this->hasMany('App\Models\Timetable', 'kcxh', 'kcxh')
			->whereNd(session('year'))
			->whereXq(session('term'));
	}

	/**
	 * 扩展查询，用于获取已选课程学分
	 * @author FuRongxin
	 * @date    2016-01-23
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectedCredits($query, $user) {
		return $query->whereNd(session('year'))
			->whereXq(session('term'))
			->whereXh($user->xh)
			->groupBy('pt', 'xz')
			->selectRaw('pt, xz, SUM(xf) AS xf');
	}

	/**
	 * 扩展查询，用于获取已选课程列表
	 * @author FuRongxin
	 * @date    2016-02-16
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectedCourses($query, $user) {
		return $query->with([
			'timetables'                  => function ($query) {
				$query->select('kcxh', 'ksz', 'jsz', 'zc', 'ksj', 'jsj', 'cdbh', 'xqh', 'jsgh')
					->orderBy('ksj', 'asc')
					->orderBy('zc', 'asc')
					->orderBy('ksz', 'asc');
			},
			'timetables.classroom'        => function ($query) {
				$query->select('jsh', 'mc');
			},
			'timetables.campus'           => function ($query) {
				$query->select('dm', 'mc');
			},
			'timetables.teacher'          => function ($query) {
				$query->select('jsgh', 'xm', 'zc');
			},
			'timetables.teacher.position' => function ($query) {
				$query->select('dm', 'mc');
			},
			'course'                      => function ($query) {
				$query->select('kch', 'kcmc');
			},
		])
			->whereXh($user->xh)
			->whereNd(session('year'))
			->whereXq(session('term'));
	}

}
