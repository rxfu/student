<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 国家考试报名专业限制表
 *
 * @author FuRongxin
 * @date 2017-05-23
 * @version 2.1.6
 */
class Exlimit extends Model {

	protected $table = 'ks_bmzyxz';

	protected $primaryKey = 'kslx';

	public $incremeting = false;

	public $timestamps = false;

	/**
	 * 考试类型
	 * @author FuRongxin
	 * @date    2017-05-23
	 * @version 2.1.6
	 * @return  object 所属对象
	 */
	public function type() {
		return $this->belongsTo('App\Models\Extype', 'c_kslx', 'kslx');
	}

	/**
	 * 专业
	 * @author FuRongxin
	 * @date    2017-05-23
	 * @version 2.1.6
	 * @return  object     所属对象
	 */
	public function major() {
		return $this->belongsTo('App\Models\Major', 'zy', 'zy');
	}

	/**
	 * 学院
	 * @author FuRongxin
	 * @date    2017-05-23
	 * @version 2.1.6
	 * @return  object     所属对象
	 */
	public function college() {
		return $this->belongsTo('App\Models\Department', 'xy', 'dw');
	}

}
