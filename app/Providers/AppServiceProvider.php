<?php

namespace App\Providers;

use App\Models\Fresh;
use App\Models\Profile;
use App\Models\Setting;
use Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		view()->composer('app', function ($view) {

			// 是否新生
			if ($is_fresh = Fresh::whereXh(Auth::user()->xh)->exists()) {
				$user = Fresh::find(Auth::user()->xh);
			}

			// 是否在校生
			if ($is_student = Profile::whereXh(Auth::user()->xh)->whereXjzt(config('constants.school.student'))->exists()) {
				$user = Profile::find(Auth::user()->xh);
			}

			// 是否新入校未足一年的学生
			$is_newer = Profile::isFresh(Auth::user())->exists();

			// 是否允许选课
			$allowed_select = Setting::find('XK_KG')->value;

			// 是否允许选通识素质课
			$allowed_general = Setting::find('XK_TS')->value;

			// 是否允许选其他课程
			$allowed_others = Setting::find('XK_QT')->value;

			// 是否允许公体选课
			$allowed_pubsport = Setting::find('XK_GT')->value;

			// 是否允许课程申请
			// 2016-11-30：应教务处要求添加
			$allowed_apply = Setting::find('XK_SQ')->value;

			$view->withIsFresh($is_fresh)
				->withIsStudent($is_student)
				->withUser($user)
				->withIsNewer($is_newer)
				->withAllowedSelect($allowed_select)
				->withAllowedGeneral($allowed_general)
				->withAllowedOthers($allowed_others)
				->withAllowedPubsport($allowed_pubsport)
				->withAllowedApply($allowed_apply);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
