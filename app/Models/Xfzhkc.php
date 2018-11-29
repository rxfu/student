<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 学分转换课程对照
 *
 * @author FuRongxin
 * @date 2018-11-29
 * @version 2.4
 */
class Xfzhkc extends Model {

	protected $table = 'xk_xfzhkc';

	protected $primaryKey = 'id';

	public $timestamps = false;

	public function application() {
		return $this->belongsTo('App\Models\Xfzhsq', 'appid', 'id');
	}
}
