<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 国家考试成绩单
 *
 * @author FuRongxin
 * @date 2016-01-28
 * @version 2.0
 */
class Exscore extends Model {

	protected $table = 'cj_qtkscj';

	protected $primaryKey = 'c_xh';

	public $incremeting = false;

	public $timestamps = false;

	/**
	 * 考试类型
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function type() {
		return $this->belongsTo('App\Models\Extype', 'kslx', 'c_kslx');
	}
}
