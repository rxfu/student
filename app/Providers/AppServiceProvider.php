<?php

namespace App\Providers;

use App\Models\Dcxmxt;
use App\Models\Profile;
use App\Models\Setting;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer(['app', 'application.index'], function ($view) {

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
			// 2019-02-23：教务处要求取消学籍状态认证
			// if ($is_student = Profile::whereXh(Auth::user()->xh)->whereXjzt(config('constants.school.student'))->exists()) {
			// 	$user = Profile::find(Auth::user()->xh);
			// }
			if ($is_student = Profile::whereXh(Auth::user()->xh)->exists()) {
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

			// 是否允许选“四史”教育通识素质课程
			// 2021-07-19：应教务处要求添加
			$allowed_history4 = Setting::find('XK_TS_TH')->value;

			// 是否允许申请大创项目
			// 2018-03-28：应教务处要求添加
			// 2020-12-17：应教务处要求关闭大创项目
			// $allowed_dcxm = Dcxmxt::find('XT_KG')->value;
			$allowed_dcxm = false;

			// 是否已经进入学分结算流程
			// 2021-06-08：应教务处要求不允许进入学分结算流程的学生进行选课及申请选课
			$is_settled = Profile::whereXh(Auth::user()->xh)->where('cwzt', '<>', '0')->exists();

			$view->with('is_student', $is_student)
				->with('user', $user)
				->with('is_newer', $is_newer)
				->with('allowed_select', $allowed_select)
				->with('allowed_general', $allowed_general)
				->withs('allowed_others', $allowed_others)
				->with('allowed_pubsport', $allowed_pubsport)
				->with('allowed_apply', $allowed_apply)
				->with('allowed_dcxm', $allowed_dcxm)
				->with('is_settled', $is_settled)
				->with('allowed_history4', $allowed_history4);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
