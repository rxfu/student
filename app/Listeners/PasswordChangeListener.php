<?php

namespace App\Listeners;

use App\Events\PasswordChange;
use App\Models\Slog;
use Illuminate\Http\Request;

/**
 * 监听修改密码事件
 *
 * @author FuRonxin
 * @date 2016-01-15
 * @version 2.0
 */
class PasswordChangeListener {

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
	 * @param  PasswordChange  $event
	 * @return void
	 */
	public function handle(PasswordChange $event) {
		$log = new Slog;

		$log->ip   = request()->ip();
		$log->czlx = 'chgpwd';

		$log->save();
	}
}
