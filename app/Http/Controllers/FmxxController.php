<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFmxxRequest;
use App\Models\Fmxx;

class FmxxController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$types = [
			'',
			'1-居民身份证',
			'6-香港特区护照/身份证明',
			'7-澳门特区护照/身份证明',
			'8-台湾居民来往大陆通行证',
			'9-境外永久居住证',
			'A-护照',
			'C-港澳台居民居住证',
		];
		$title = '父母监控人信息录入';

		return view('fmxx.index', compact('types', 'title'));
	}

	public function parent(StoreFmxxRequest $request) {
		$student = new Fmxx;
		$student->fill($request->all());
		$student->save();

		return redirect('/home');
	}
}
