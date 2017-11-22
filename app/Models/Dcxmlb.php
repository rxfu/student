<?php

namespace App\Models;

use App\Models\DcxmModel;

/**
 * 大创项目类别
 *
 * @author FuRongxin
 * @date 2017-11-22
 * @version 2.3
 */
class Dcxmlb extends DcxmModel {

	protected $table = 'dc_xmlb';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 项目信息
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  object 所属对象
	 */
	public function projects() {
		return $this->hasMany('App\Models\Dcxmxx', 'xmlb_dm', 'dm');
	}
}
