<?php

namespace App\Listeners;

use App\Models\Fresh;
use App\Models\Profile;
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
		if (!Fresh::whereXh(Auth::user()->xh)->exists()) {
			if (!Profile::whereXh(Auth::user()->xh)->whereXjzt(config('constants.school.student'))->exists()) {
				Auth::logout();
				return back()->withInput()->withStatus('不是在校生，请不要登录系统');
			}
		}

		session([
			'year'   => Setting::find('XK_ND')->value,
			'term'   => Setting::find('XK_XQ')->value,
			'campus' => Auth::user()->profile->college->pivot->xq,
			'season' => Auth::user()->profile->zsjj,
			'grade'  => Auth::user()->profile->nj,
			'major'  => Auth::user()->profile->zy,
		]);

		$log       = new Slog();
		$log->ip   = request()->ip();
		$log->czlx = 'login';
		$log->save();
	}
}
