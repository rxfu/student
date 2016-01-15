<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学生短消息
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
class Message extends Model {

	protected $table = 'xk_dxx';

	public $timestamps = false;

	/**
	 * 学生用户
	 * @author FuRongxin
	 * @date    2016-01-15
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function user() {
		return $this->belongsTo('App\Models\User', 'xh', 'xh');
	}
}
