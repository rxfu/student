<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 处分信息
 *
 * @author FuRongxin
 * @date 2017-10-27
 * @version 2.2.4
 */
class Cfxx extends Model {

	protected $table = 'xj_cfxx';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	protected $dates = [
		'cfrq',
	];

	/**
	 * 处分结果
	 * @author FuRongxin
	 * @date    2017-10-27
	 * @version 2.2.4
	 * @return  object 所属对象
	 */
	public function jg() {
		return $this->belongsTo('App\Models\Cfjg', 'cfjg', 'dm');
	}

	/**
	 * 处分原因
	 * @author FuRongxin
	 * @date    2017-10-27
	 * @version 2.2.4
	 * @return  object 所属对象
	 */
	public function yy() {
		return $this->belongsTo('App\Models\Cfyy', 'cfyy', 'dm');
	}

	/**
	 * 学生信息
	 * @author FuRongxin
	 * @date    2017-10-27
	 * @version 2.2.4
	 * @return  object 所属对象
	 */
	public function profile() {
		return $this->belongsTo('App\Models\Profile', 'xh', 'xh');
	}
}
