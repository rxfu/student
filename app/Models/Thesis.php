<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 毕业论文表
 *
 * @author FuRongxin
 * @date 2017-05-29
 * @version 2.2
 */
class Thesis extends Model {

	protected $table = 'sj_bylw';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 指导教师
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object 所属对象
	 */
	public function instructor() {
		return $this->belongsTo('App\Models\Teacher', 'zdjs', 'jsgh');
	}

	/**
	 * 评阅教师
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object 所属对象
	 */
	public function reviewer() {
		return $this->belongsTo('App\Models\Teacher', 'pyjs', 'jsgh');
	}

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object     所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}

	/**
	 * 主修专业
	 * @author FuRongxin
	 * @date    2017-05-29
	 * @version 2.2
	 * @return  object     所属对象
	 */
	public function major() {
		return $this->belongsTo('App\Models\Major', 'zy', 'zy');
	}

}
