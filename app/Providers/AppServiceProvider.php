<?php

namespace App\Providers;

use App\Models\Exregister;
use App\Models\Fresh;
use App\Models\Profile;
use App\Models\Slog;
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

			$view->withIsFresh($is_fresh)
				->withIsStudent($is_student)
				->withUser($user);
		});

		Exregister::created(function ($exam) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->czlx = 'regist';

			$log->save();
		});

		Exregister::deleted(function ($exam) {
			$log = new Slog;

			$log->ip   = request()->ip();
			$log->czlx = 'cancel';

			$log->save();
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
