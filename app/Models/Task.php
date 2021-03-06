<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 教学任务书
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class Task extends Model {

	protected $table = 'pk_jxrw';

	protected $primaryKey = 'jsgh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学生综合成绩
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function scores() {
		return $this->hasMany('App\Models\Score', 'kch', 'kch');
	}

	/**
	 * 学生过程成绩
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function dtscores() {
		return $this->hasMany('App\Models\Dtscore', 'kcxh', 'kcxh');
	}

	/**
	 * 学生补考成绩
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function muscores() {
		return $this->hasMany('App\Models\Muscore', 'kcxh', 'kcxh');
	}

	/**
	 * 课程
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function course() {
		return $this->belongsTo('App\Models\Course', 'kch', 'kch');
	}

	/**
	 * 成绩比例
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function ratio() {
		return $this->belongsTo('App\Models\Ratio', 'cjfs', 'fs');
	}
}
