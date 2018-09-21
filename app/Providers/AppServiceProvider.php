<?php

namespace App\Providers;

use App\Models\Dcxmxt;
use App\Models\Profile;
use App\Models\Setting;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		View::composer('app', function ($view) {

			/**
			 * 2018-09-21：应教务处要求关闭新生检测
			 */
			// 是否新生
			/*
			if ($is_fresh = Fresh::whereXh(Auth::user()->xh)->exists()) {
				$user = Fresh::find(Auth::user()->xh);
			}
			*/
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

			// 是否允许申请大创项目
			// 2018-03-28：应教务处要求添加
			$allowed_dcxm = Dcxmxt::find('XT_KG')->value;

			$view->with('is_student', $is_student)
				->with('user', $user)
				->with('is_newer', $is_newer)
				->with('allowed_select', $allowed_select)
				->with('allowed_general', $allowed_general)
				->withs('allowed_others', $allowed_others)
				->with('allowed_pubsport', $allowed_pubsport)
				->with('allowed_apply', $allowed_apply)
				->with('allowed_dcxm', $allowed_dcxm);
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
