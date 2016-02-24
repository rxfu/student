<?php

namespace App\Listeners;

use App\Models\Slog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

/**
 * 监听登出事件
 *
 * @author FuRongxin
 * @date 2016-01-15
 * @version 2.0
 */
class AuthLogoutListener {

	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  Logout  $event
	 * @return void
	 */
	public function handle(Logout $event) {
		request()->session()->flush();

		$log       = new Slog;
		$log->ip   = request()->ip();
		$log->czlx = 'logout';
		$log->save();
	}
}
