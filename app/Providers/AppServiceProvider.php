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

			// 是否允许选课
			$allowed_select = Setting::find('XK_KG')->value;

			// 是否允许选通识素质课
			$allowed_general = Setting::find('XK_TS')->value;

			// 是否允许选其他课程
			$allowed_others = Setting::find('XK_QT')->value;

			// 是否允许公体选课
			$allowed_pubsport = Setting::find('XK_GT')->value;

			$view->withIsFresh($is_fresh)
				->withIsStudent($is_student)
				->withUser($user)
				->withAllowedSelect($allowed_select)
				->withAllowedGeneral($allowed_general)
				->withAllowedOthers($allowed_others)
				->withAllowedPubsport($allowed_pubsport);
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
