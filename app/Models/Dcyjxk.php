<?php

namespace App\Models;

use App\Models\DcxmModel;

/**
 * 大创项目一级学科
 *
 * @author FuRongxin
 * @date 2017-11-22
 * @version 2.3
 */
class Dcyjxk extends DcxmModel {

	protected $table = 'dc_yjxk';

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
		return $this->hasMany('App\Models\Dcxmxx', 'yjxk_dm', 'dm');
	}
}
