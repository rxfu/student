<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 国家考试类型
 *
 * @author FuRongxin
 * @date 2016-01-28
 * @version 2.0
 */
class Extype extends Model {

	protected $table = 'cj_kslxdm';

	protected $primaryKey = 'kslx';

	public $incremeting = false;

	public $timestamps = false;

	/**
	 * 国家考试成绩
	 * @author FuRongxin
	 * @date    2016-01-28
	 * @version 2.0
	 * @return  object  所属对象
	 */
	public function scores() {
		return $this->hasMany('App\Models\Exscore', 'kslx', 'c_kslx');
	}
}
