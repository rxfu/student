<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$broadcasts = Broadcast::where('id', '=', 'xt_web')->get();

		return view('home.index', ['title' => '综合管理系统', 'broadcasts' => $broadcasts]);
	}
}
