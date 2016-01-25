<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生过程成绩
 *
 * @author FuRongxin
 * @date 2016-01-25
 * @version 2.0
 */
class Dtscore extends Model {

	protected $table = 'cj_lscj';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-01-25
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function task() {
		return $this->belongsTo('App\Models\Task', 'kcxh', 'kcxh')
			->whereNd($this->nd)
			->whereXq($this->xq);
	}
}
