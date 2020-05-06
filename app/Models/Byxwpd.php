<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学位评定情况
 *
 * @author FuRongxin
 * @date 2019-11-08
 * @version 2.2.5
 */
class Byxwpd extends Model {

	protected $table = 'by_xwpdb';

	protected $primaryKey = 'xh';

	public $incrementing = false;

	public $timestamps = false;

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
