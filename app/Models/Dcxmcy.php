<?php

namespace App\Models;

use App\Models\DcxmModel;

/**
 * 大创项目成员
 *
 * @author FuRongxin
 * @date 2017-12-04
 * @version 2.3
 */
class Dcxmcy extends DcxmModel {

	protected $table = 'dc_xmcy';

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
