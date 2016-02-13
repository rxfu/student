<?php

namespace App\Providers;

use App\Models\Fresh;
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
			$is_fresh = Fresh::whereXh(Auth::user()->xh)->exists();
			$is_student=Profile::whereXh(Auht::user()->xh)

			$view->withIsFresh($is_fresh);
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
