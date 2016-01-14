<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 学生日志
 *
 * @author FuRongxin
 * @date 2016-01-12
 * @version 2.0
 */
class Slog extends Model {

	protected $table = 'xk_log';

	public $timestamps = false;

	/**
	 * 学生用户
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  object 所属对象
	 */
	public function user() {
		return $this->belongsTo('App\Models\User', 'xh', 'xh');
	}

	/**
	 * Save the model to the database.
	 *
	 * @param  array  $options
	 * @return bool
	 */
	public function save(array $options = []) {
		$this->xh   = Auth::user()->xh;
		$this->czsj = Carbon::now();

		return parent::save($options);
	}
}
