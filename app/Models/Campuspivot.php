<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学院校区对应表
 *
 * @author FuRongxin
 * @date 2016-02-22
 * @version 2.0
 */
class Campuspivot extends Model {

	protected $table = 'xk_xyxq';

	protected $primaryKey = 'xy';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}

	/**
	 * 校区
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @return  object     所属对象
	 */
	public function campus() {
		return $this->belongsTo('App\Models\Campus', 'xq', 'dm');
	}
}
