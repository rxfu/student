<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
	 * 转换获取操作类型代码为小写
	 * @author FuRongxin
	 * @date    2016-01-15
	 * @version 2.0
	 * @param   string $value 操作类型代码
	 * @return  string 转换后操作类型代码
	 */
	public function getCzlxAttribute($value) {
		return Str::lower($value);
	}

	/**
	 * 转换设置操作类型代码为大写
	 * @author FuRongxin
	 * @date    2016-01-15
	 * @version 2.0
	 * @param   string $value 操作类型代码
	 */
	public function setCzlxAttribute($value) {
		$this->attributes['czlx'] = Str::upper($value);
	}

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
		$this->bz   = isset($this->bz) ? $this->bz : '';

		return parent::save($options);
	}
}
