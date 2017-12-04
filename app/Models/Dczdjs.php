<?php

namespace App\Models;

/**
 * 大创项目指导教师
 *
 * @author FuRongxin
 * @date 2017-12-04
 * @version 2.3
 */
class Dczdjs extends DcxmModel {

	protected $table = 'dc_zdjs';

	protected $primaryKey = 'id';

	public $timestamps = false;

	/**
	 * 项目信息
	 * @author FuRongxin
	 * @date    2017-12-04
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function projects() {
		return $this->belongsTo('App\Models\Dcxmxx', 'xm_id', 'id');
	}
}
