<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 毕业结果分类
 *
 * @author FuRongxin
 * @date 2019-11-08
 * @version 2.2.5
 */
class Byflzd extends Model {

	protected $table = 'by_flzd';

	protected $primaryKey = 'dm';

	public $incrementing = false;

	public $timestamps = false;

	/**
	 * 毕业情况
	 * @author FuRongxin
	 * @date    2019-11-08
	 * @version 2.2.5
	 * @return  object 所属对象
	 */
	public function bymds() {
		return $this->hasMany('App\Models\Bymd', 'jg', 'dm');
	}
}
