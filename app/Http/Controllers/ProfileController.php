<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;

class ProfileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$profile = Profile::find(Auth::user()->xh);

		return view('profile.index', ['title' => '个人资料', 'profile' => $profile]);
	}

}
