<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 考试报名信息
 *
 * @author FuRongxin
 * @date 2016-02-21
 * @version 2.0
 */
class Exregister extends Model {

	protected $table = 'ks_qtksbm';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 考试类型
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function type() {
		return $this->belongsTo('App\Models\Extype', 'kslx', 'kslx');
	}

	/**
	 * 校区
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function campus() {
		return $this->belongsTo('App\Models\Campus', 'xq', 'dm');
	}
}