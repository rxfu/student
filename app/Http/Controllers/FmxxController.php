<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFmxxRequest;
use App\Models\Fmxx;
use Auth;

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
		$title  = '个人信息核对及父母或监护人信息填报';
		$parent = Fmxx::find(Auth::user()->xh);

		return view('fmxx.index', compact('types', 'title', 'parent'));
	}

	public function parent(StoreFmxxRequest $request) {
		if ($request->isMethod('post')) {
			if (Fmxx::whereXh(Auth::user()->xh)->exists()) {
				$student = Fmxx::findOrFail(Auth::user()->xh);
			} else {
				$student = new Fmxx;
			}

			$student->fill($request->all());
			$student->save();
		}

		return redirect('/home');
	}
}
