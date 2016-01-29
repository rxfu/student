<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 教学计划
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class Plan extends Model {

	protected $table = 'jx_jxjh';

	protected $primaryKey = 'kch';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 课程平台
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function platform() {
		return $this->belongsTo('App\Models\Platform', 'pt', 'dm');
	}

	/**
	 * 课程性质
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function property() {
		return $this->belongsTo('App\Models\Property', 'xz', 'dm');
	}

	/**
	 * 课程信息
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function course() {
		return $this->belongsTo('App\Models\Course', 'kch', 'kch');
	}

	/**
	 * 开课学院
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'kxy', 'dw');
	}

	/**
	 * 考核方式
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function mode() {
		return $this->belongsTo('App\Models\Mode', 'kh', 'dm');
	}

	/**
	 * 专业课程信息
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function mjcourses() {
		return $this->hasMany('App\Models\Mjcourse', 'zy', 'zy')
			->whereNj($this->nj)
			->whereZsjj($this->zsjj);
	}
}
