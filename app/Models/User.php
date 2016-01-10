<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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

	public function getAuthIdentifierName() {
		return $this->xh;
	}

	public function getAuthPassword() {
		return $this->mm;
	}

	public function getRememberToken() {
		return null;
	}

	public function setRememberToken($value) {

	}

	public function getRememberTokenName() {
		return null;
	}

	/**
	 * 覆盖原方法，忽略remember token
	 */
	public function setAttribute($key, $value) {
		if ($key != $this->getRememberTokenName()) {
			parent::setAttribute($key, $value);
		}
	}
}
