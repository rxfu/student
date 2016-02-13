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
			// 判断是否是新生
			$is_fresh = Fresh::whereXh(Auth::user()->xh)->exists();
			// 判断是否是在校生
			$is_student = Profile::whereXh(Auth::user()->xh)->whereXjzt(config('constants.school.student'));

			$view->withIsFresh($is_fresh)->withIsStudent($is_student);
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
