<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学分转换申请
 *
 * @author FuRongxin
 * @date 2018-11-29
 * @version 2.4
 */
class Xfzhsq extends Model {

	protected $table = 'xk_xfzhsq';

	protected $primaryKey = 'id';

	public $timestamps = false;

	public function courses() {
		return $this->hasMany('App\Models\Xfzhkc', 'appid', 'id');
	}
}
