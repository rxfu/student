<?php

namespace App\Models;

use App\Http\Helper;
use App\Models\BaseModel as Model;
use App\Models\Count;
use App\Models\Slog;

/**
 * 选课信息
 *
 * @author FuRongxin
 * @date 2016-09-01
 * @version 2.1.2
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

			// 2016-09-01：应教务处要求添加公体选课统计，修改选课统计方式
			// 2019-12-11：应教务处要求更改统计方式，把选课统计放入事务处理
			/*
			if ($isPubSport = Helper::isCourseType($course->kcxh, 'TB14')) {
				$count = Count::whereKcxh($course->kcxh)->first();
			} else {
				$count = Count::whereKcxh($course->kcxh)
					->whereZy($course->zy)
					->first();
			}

			if (is_null($count)) {
				$count       = new Count;
				$count->kcxh = $course->kcxh;
				$count->zy   = $isPubSport ? '' : $course->zy;
				$count->rs   = 1;
			} else {
				$count->rs += 1;
			}

			$count->save();
*/
			/*
			$log       = new Slog;
			$log->kcxh = $course->kcxh;
			$log->kcmc = $course->course->kcmc;
			$log->ip   = request()->ip();
			$log->czlx = 'insert';
			$log->save();
			*/
		});

		static::deleted(function ($course) {

			// 2016-09-01：应教务处要求添加公体选课统计，修改选课统计方式
			// 2019-12-11：应教务处要求更改统计方式，把选课统计放入事务处理
			/*
			if ($isPubSport = Helper::isCourseType($course->kcxh, 'TB14')) {
				$count = Count::whereKcxh($course->kcxh)->first();
			} else {
				$count = Count::whereKcxh($course->kcxh)
					->whereZy($course->zy)
					->first();
			}

			if (is_null($count)) {
				$count       = new Count;
				$count->kcxh = $course->kcxh;
				$count->zy   = $isPubSport ? '' : $course->zy;
				$count->rs   = 0;
			} else {
				$count->rs -= 1;
			}

			$count->save();
*/
/*
			$log       = new Slog;
			$log->kcxh = $course->kcxh;
			$log->kcmc = $course->course->kcmc;
			$log->ip   = request()->ip();
			$log->czlx = 'delete';
			$log->save();
			*/
		});
	}

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-06-02
	 * @version 2.1
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-06-02
	 * @version 2.1
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'xz', 'dm');
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
	 * 历史排课表
	 * @author FuRongxin
	 * @date    2019-06-18
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function historyTimetables() {
		return $this->hasMany('App\Models\Timetable', 'kcxh', 'kcxh')
			->whereNd($this->nd)
			->whereXq($this->xq);
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
	 * 扩展查询，用于获取所有已选且未重修课程学分
	 * @author FuRongxin
	 * @date    2019-10-8
	 * @version 2.3
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectedUnretakeCredits($query, $user) {
		return $query->whereXh($user->xh)
			->whereCx(0)
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
			return $query->where('xk_xkxx.pt', '=', 'T')
				->where('xk_xkxx.xz', '=', 'B');

		case 'require':
			$platforms = array_pluck(Platform::all()->toArray(), 'dm');
			unset($platforms[array_search('T', $platforms)]);
			return $query->whereIn('xk_xkxx.pt', $platforms)
				->where('xk_xkxx.xz', '=', 'B');

		case 'elect':
			return $query->where('xk_xkxx.xz', '=', 'X');

		case 'human':
		case 'nature':
		case 'art':
		case 'other':
			return $query->where('xk_xkxx.pt', '=', 'T')
				->whereIn('xk_xkxx.xz', ['W', 'I', 'Y', 'Q']);

		case 'pubsport':
			return $query->where('xk_xkxx.pt', '=', 'T')
				->where('xk_xkxx.xz', '=', 'B')
				->where('xk_xkxx.kcxh', 'like', 'TB14%');

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

	/**
	 * 扩展查询：根据课程号获取已选课程列表
	 * @author FuRongxin
	 * @date    2017-05-16
	 * @version 2.1.5
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @param   string $kch 8位课程号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelected($query, $user, $kch) {
		return $query->whereXh($user->xh)
			->whereKch($kch);
	}

	/**
	 * 扩展查询，用于获取历史已选课程列表
	 * @author FuRongxin
	 * @date    2019-06-18
	 * @version 2.3
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   object $user 用户对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectedHistoryCourses($query, $user) {
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
			->where('nd', '<>', session('year'))
			->where('xq', '<>', session('term'));
	}
}
