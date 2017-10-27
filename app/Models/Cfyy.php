<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 处分原因
 *
 * @author FuRongxin
 * @date 2017-10-27
 * @version 2.2.4
 */
class Cfyy extends Model {

	protected $table = 'xj_cfyy';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 处分信息
	 * @author FuRongxin
	 * @date    2017-10-27
	 * @version 2.2.4
	 * @return  object 所属对象
	 */
	public function cfxxs() {
		return $this->hasMany('App\Models\Cfxx', 'cfyy', 'dm');
	}
}
