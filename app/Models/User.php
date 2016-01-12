<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 用户登录信息
 *
 * @author FuRongxin
 * @date 2016-1-12
 * @version 2.0
 */
class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'xh', 'mm', 'zpzt',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'mm', 'zpzt',
	];

	protected $table = 'xk_xsmm';

	public $incrementing = false;

	public $timestamps = false;

	protected $primaryKey = 'xh';

	/**
	 * 获取用户名
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  string 用户名
	 */
	public function getAuthIdentifierName() {
		return $this->xh;
	}

	/**
	 * 获取密码
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  string 密码
	 */
	public function getAuthPassword() {
		return $this->mm;
	}

	/**
	 * 获取remember token
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  null
	 */
	public function getRememberToken() {
		return null;
	}

	/**
	 * 设置remember token
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @param   string $value token值
	 */
	public function setRememberToken($value) {

	}

	/**
	 * 获取remember token名
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 * @return  null
	 */
	public function getRememberTokenName() {
		return null;
	}

	/**
	 * 覆盖原方法，忽略remember token
	 * @author FuRongxin
	 * @date    2016-01-12
	 * @version 2.0
	 */
	public function setAttribute($key, $value) {
		if ($key != $this->getRememberTokenName()) {
			parent::setAttribute($key, $value);
		}
	}
}
