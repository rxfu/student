<?php

namespace App\Http\Middleware;

use App\Models\Register;
use App\Models\Setting;
use Auth;
use Carbon\Carbon;
use Closure;

class CheckRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $begin = new Carbon(Setting::find('XS_ZC_KS')->value);
        $end = new Carbon(Setting::find('XS_ZC_JS')->value);

        if (now()->between($begin, $end) && !Register::whereXh(Auth::user()->xh)->whereNd(session('year'))->whereXq(session('term'))->exists()) {
            return redirect()->route('profile.register');
        }

        return $next($request);
    }
}
