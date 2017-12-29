<?php

namespace App\Models;

/**
 * 大创项目申报书
 *
 * @author FuRongxin
 * @date 2017-12-29
 * @version 2.3
 */
class Dcxmsq extends DcxmModel {

	protected $table = 'dc_xmsq';

	protected $primaryKey = 'xm_id';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 项目信息
	 * @author FuRongxin
	 * @date    2017-12-29
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function projects() {
		return $this->belongsTo('App\Models\Dcxmxx', 'xm_id', 'id');
	}

}
