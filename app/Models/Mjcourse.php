<?php

namespace App\Models;

use DB;
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
			->orderBy('zc');
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

	/**
	 * 扩展查询，用于获取对应年级课程信息
	 * @author FuRongxin
	 * @date    2016-03-07
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $grade 年级
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfGrade($query, $grade) {
		if ('all' !== $grade) {
			return $query->where('pk_kczy.nj', '=', $grade);
		}
	}

	/**
	 * 扩展查询，用于获取对应学院课程信息
	 * @author FuRongxin
	 * @date    2016-03-07
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $college 学院
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfCollege($query, $college) {
		if ('all' !== $college) {
			return $query->where('pk_kczy.kkxy', '=', $college);
		}
	}

	/**
	 * 扩展查询，用于获取对应专业课程信息
	 * @author FuRongxin
	 * @date    2016-03-07
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $major 专业
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeOfMajor($query, $major) {
		if ('all' !== $major) {
			return $query->where('pk_kczy.zy', '=', $major);
		}
	}

	/**
	 * 扩展查询，用于获取课程类型相应课程的课程列表
	 * @author FuRongxin
	 * @date    2016-03-01
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

		default:
			break;
		}
	}

	/**
	 * 扩展查询，获取排除通识素质课的课程数据
	 * @author FuRongxin
	 * @date    2016-03-09
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeExceptGeneral($query) {
		return $query->whereNotExists(function ($query) {
			$query->from('pk_kczy AS a')
				->whereRaw('t_a.nd = t_pk_kczy.nd AND t_a.xq = t_pk_kczy.xq AND t_a.zsjj = t_pk_kczy.zsjj AND t_a.kcxh = t_pk_kczy.kcxh')
				->wherePt('T')
				->where(function ($query) {
					$query->whereXz('W')
						->orWhere('xz', '=', 'I')
						->orWhere('xz', '=', 'Y')
						->orWhere('xz', '=', 'Q');
				});
		});
	}

	/**
	 * 扩展查询：用于获取可选课程列表
	 * @author FuRongxin
	 * @date    2016-03-01
	 * @version 2.0
	 * @param   \Illuminate\Database\Eloquent\Builder $query 查询对象
	 * @param   string $campus 校区号
	 * @return  \Illuminate\Database\Eloquent\Builder 查询对象
	 */
	public function scopeSelectable($query, $campus) {
		$campus = ('unknown' == $campus) ? '' : $campus;
		return $query->join('jx_jxjh', function ($join) {
			$join->on('pk_kczy.zy', '=', 'jx_jxjh.zy')
				->on('pk_kczy.nj', '=', 'jx_jxjh.nj')
				->on('pk_kczy.zsjj', '=', 'jx_jxjh.zsjj');
		})
			->join('zd_khfs', 'jx_jxjh.kh', '=', 'zd_khfs.dm')
			->join('jx_kc', 'jx_jxjh.kch', '=', 'jx_kc.kch')
			->join('pk_kb', function ($join) {
				$join->on('pk_kczy.nd', '=', 'pk_kb.nd')
					->on('pk_kczy.xq', '=', 'pk_kb.xq')
					->on('pk_kczy.kcxh', '=', 'pk_kb.kcxh');
			})
			->join('pk_js', 'pk_kb.jsgh', '=', 'pk_js.jsgh')
			->join('xk_tj', function ($join) {
				$join->on('pk_kczy.kcxh', '=', 'xk_tj.kcxh');
			})
			->where('pk_kb.xqh', '=', $campus)
			->whereRaw('t_jx_jxjh.kch = substring(t_pk_kczy.kcxh, 3, 8)')
			->where('pk_kczy.nd', '=', session('year'))
			->where('pk_kczy.xq', '=', session('term'))
			->where('pk_kczy.zsjj', '=', session('season'))
			->groupBy('pk_kczy.kcxh', 'jx_jxjh.kch', 'jx_jxjh.zxf', 'jx_jxjh.kh', 'jx_kc.kcmc', 'pk_kczy.rs', 'pk_kb.xqh', 'xk_tj.rs', 'zd_khfs.mc')
			->select('pk_kczy.kcxh', 'jx_jxjh.kch', 'jx_jxjh.zxf', 'jx_jxjh.kh', 'jx_kc.kcmc', 'pk_kczy.rs AS zrs', 'pk_kb.xqh', 'xk_tj.rs', 'zd_khfs.mc AS kh')
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_kb.zc), \',\') AS zcs'))
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_kb.ksz), \',\') AS kszs'))
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_kb.jsz), \',\') AS jszs'))
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_kb.ksj), \',\') AS ksjs'))
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_kb.jsj), \',\') AS jsjs'))
			->addSelect(DB::raw('array_to_string(array_agg(t_pk_js.xm), \',\') AS jsxms'))
			->orderBy('pk_kczy.kcxh');
	}

}
