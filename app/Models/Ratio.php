<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 成绩比你
 *
 * @author FuRongxin
 * @date 2016-01-26
 * @version 2.0
 */
class Ratio extends Model {

	protected $table = 'jx_cjfs';

	protected $primaryKey = 'fs';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 教学任务书
	 * @author FuRongxin
	 * @date    2016-01-26
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function tasks() {
		return $this->hasMany('App\Models\Task', 'cjfs', 'fs');
	}
}
