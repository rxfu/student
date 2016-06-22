<?php

namespace App\Models;

use App\Models\BaseModel as Model;

/**
 * 选课人数统计
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class Count extends Model {

	protected $table = 'xk_tj';

	protected $primaryKey = 'kcxh';

	public $incrementing = false;

	public $timestamps = false;

	// 修复保存操作
	protected $secondaryKey = ['kcxh', 'zy'];

	/**
	 * 课程表
	 * @author FuRongxin
	 * @date    2016-02-24
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function timetable() {
		return $this->belongsTo('App\Models\Timetable', 'kcxh', 'kcxh');
	}
}
