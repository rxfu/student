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

	public function scopeOfType($query, $type) {
		switch ($type) {
		case 'public':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'B')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'require':
			return $query->where('pk_kczy.xz', '=', 'B')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'elect':
			return $query->where('pk_kczy.xz', '=', 'X')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'human':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'W')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'nature':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'I')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'art':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'Y')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		case 'other':
			return $query->where('pk_kczy.pt', '=', 'T')
				->where('pk_kczy.xz', '=', 'Q')
				->where('pk_kczy.nj', '=', session('grade'))
				->where('pk_kczy.zy', '=', session('major'));

		default:
			break;
		}
	}

	public function scopeSelectable($query) {
		return $query->join('jx_jxjh', function ($join) {
			$join->on('pk_kczy.zy', '=', 'jx_jxjh.zy')
				->on('pk_kczy.nj', '=', 'jx_jxjh.nj')
				->on('pk_kczy.zsjj', '=', 'jx_jxjh.zsjj');
		})
			->join('xk_tj', function ($join) {
				$join->on('pk_kczy.kcxh', '=', 'xk_tj.kcxh');
			})
			->whereRaw('t_jx_jxjh.kch = substring(t_pk_kczy.kcxh, 3, 8)')
			->where('pk_kczy.nd', '=', session('year'))
			->where('pk_kczy.xq', '=', session('term'))
			->where('pk_kczy.zsjj', '=', session('season'));
	}

}
