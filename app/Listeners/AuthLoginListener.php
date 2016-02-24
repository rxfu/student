<?php

namespace App\Listeners;

use App\Models\Setting;
use App\Models\Slog;
use Auth;
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
	 * @param  Login  $event
	 * @return void
	 */
	public function handle(Login $event) {
		session([
			'year'   => Setting::find('XK_ND')->value,
			'term'   => Setting::find('XK_XQ')->value,
			'campus' => Auth::user()->profile->college->pivot->xq,
			'season' => Auth::user()->profile->zsjj,
			'grade'  => Auth::user()->profile->nj,
			'major'  => Auth::user()->profile->zy,
		]);

		$log       = new Slog;
		$log->ip   = request()->ip();
		$log->czlx = 'login';
		$log->save();
	}
}
