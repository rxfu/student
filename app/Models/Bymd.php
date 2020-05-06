<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 毕业情况
 *
 * @author FuRongxin
 * @date 2019-11-08
 * @version 2.2.5
 */
class Bymd extends Model {

	protected $table = 'by_md';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 审核结果
	 * @author FuRongxin
	 * @date    2019-11-08
	 * @version 2.2.5
	 * @return  object 所属对象
	 */
	public function byflzd() {
		return $this->belongsTo('App\Models\Byflzd', 'jg', 'dm')->whereLb('JG');
	}

	/**
	 * 学生信息
	 * @author FuRongxin
	 * @date    2019-11-8
	 * @version 2.2.5
	 * @return  object 所属对象
	 */
	public function profile() {
		return $this->belongsTo('App\Models\Profile', 'xh', 'xh');
	}
}
