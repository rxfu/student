<?php

namespace App\Http\Middleware;

use App\Models\Fmxx;
use Auth;
use Closure;

class CheckFmxx {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (!Fmxx::whereXh(Auth::user()->xh)->exists()) {
			return redirect('/parent');
		}
		return $next($request);
	}
}
