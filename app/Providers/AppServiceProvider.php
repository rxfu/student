<?php

namespace App\Providers;

use App\Models\Fresh;
use App\Models\Profile;
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
			if ($is_student = Profile::whereXh(Auth::user()->xh)->whereXjzt(config('constants.school.student'))->exists()) {
				// 在校生对象
				$user = Profile::find(Auth::user()->xh);
			}

			if ($is_fresh = Fresh::whereXh(Auth::user()->xh)->exists()) {
				// 新生对象
				$user = Fresh::find(Auth::user()->xh);
			}

			$view->withIsFresh($is_fresh)
				->withIsStudent($is_student)
				->withUser($user);
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
