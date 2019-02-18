<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Xfzhsq;
use Auth;
use Illuminate\Http\Request;

class XfzhController extends Controller {

	public function list() {
		$items = Xfzhsq::orderBy('sqsj', 'desc')->get();
		$title = '学分转换申请列表';

		return view('xfzh.list', compact('items', 'title'));
	}

	public function create() {
		$courses = Plan::with('course')
			->whereZy(Auth::user()->profile->zy)
			->whereNj(Auth::user()->profile->nj)
			->whereZsjj(Auth::user()->profile->zsjj)
			->get();
		$title = "学分转换申请";

		return view('xfzh.create', compact('courses', 'title'));
	}

	public function store(Request $request) {

	}

	public function delete(Request $request, $id) {

	}
}
