<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Count;
use App\Models\Slog;

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

	// 修复删除操作
	protected $secondaryKey = ['xh', 'nd', 'xq', 'kcxh'];

	public static function boot() {
		parent::boot();

		static::created(function ($course) {
			$count = Count::find($course->kcxh);
			$count->rs += 1;
			$count->save();

			$log       = new Slog;
			$log->kcxh = $course->kcxh;
			$log->ip   = request()->ip();
			$log->czlx = 'insert';
			$log->save();
		});

		static::deleted(function ($course) {
			$count = Count::find($course->kcxh);
			$count->rs -= 1;
			$count->save();

			$log       = new Slog;
			$log->kcxh = $course->kcxh;
			$log->ip   = request()->ip();
			$log->czlx = 'delete';
			$log->save();
		});
	}

	/**
	 * 学期
	 * @author FuRongxin
	 * @date    2016-03-10
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function term() {
		return $this->belongsTo('App\Models\Term', 'xq', 'dm');
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

	/**
	 * 扩展查询：用于获取课程类型相应课程的课程列表
	 * @author FuRongxin
	 * @date    2016-03-02
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $type 课程类型
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfType($query, $type) {
		switch ($type) {
		case 'public':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'B')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'require':
			$platforms = array_pluck(Platform::all()->toArray(), 'dm');
			unset($platforms[array_search('T', $platforms)]);
			return $query->whereIn('pk_kczy.pt', $platforms)
				->where('pk_kczy.xz', '=', 'B')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'elect':
			return $query->where('pk_kczy.xz', '=', 'X')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'human':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'W');

		case 'nature':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'I');

		case 'art':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'Y');

		case 'other':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'Q');

		case 'pubsport':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'B')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'))
				->where('pk_kczy.kcxh', 'like', 'TB14%');

		default:
			break;
		}
	}

	/**
	 * 扩展查询，获取已修读课程列表
	 * @author FuRongxin
	 * @date    2016-03-10
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeStudied($query, $user) {
		return $query->whereXh($user->xh)
			->whereNotExists(function ($query) {
				$query->from('xk_xkxx AS a')
					->whereNd(session('year'))
					->whereXq(session('term'))
					->whereRaw('t_a.xh = t_xk_xkxx.xh AND t_a.kcxh = t_xk_xkxx.kcxh');
			});
	}
}
