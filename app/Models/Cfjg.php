<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 处分结果
 *
 * @author FuRongxin
 * @date 2017-10-27
 * @version 2.2.4
 */
class Cfjg extends Model {

	protected $table = 'xj_cfjg';

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
		return $this->hasMany('App\Models\Cfxx', 'cfjg', 'dm');
	}
}
