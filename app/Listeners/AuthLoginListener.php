<?php

namespace App\Listeners;

use App\Models\Slog;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

/**
 * 监听登录事件
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
class AuthLoginListener {

	/**
	 * Request 对象
	 * @var Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Create the event listener.
	 *
	 * @param Illuminate\Http\Request $request 请求对象
	 * @return void
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}

	/**
	 * Handle the event.
	 *
	 * @param  Login  $event
	 * @return void
	 */
	public function handle(Login $event) {
		$log = new Slog;

		$log->ip   = $this->request->ip();
		$log->czlx = 'login';

		$log->save();
	}
}
