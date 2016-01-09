<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class DeanUserProvider extends EloquentUserProvider {

	public function __construct($model) {
		$this->model = $model;
	}

	/**
	 * 覆盖原方法，验证用户密码
	 */
	public function validateCredentials(UserContract $user, array $credentials) {
		$plain        = $credentials['mm'];
		$authPassword = $user->getAuthPassword();

		return $authPassword === $plain;
	}
}
