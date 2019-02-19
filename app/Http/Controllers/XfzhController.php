<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Score;
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
		$studied_courses = Score::with('course', 'platform', 'property')
			->whereXh(Auth::user()->xh)
			->where('xf', '<>', 0)
			->whereNotIn('kch', function ($query) {
				$query->from('xk_xfzhkc')
					->join('xk_xfzhsq', 'appid', '=', 'xk_xfzhkc.id')
					->whereXh(Auth::user()->xh)
					->whereZt(4)
					->select('qkch');
			})
			->get();

		$courses = Plan::with('course', 'platform', 'property')
			->whereZy(Auth::user()->profile->zy)
			->whereNj(Auth::user()->profile->nj)
			->whereZsjj(Auth::user()->profile->zsjj)
			->WhereNotIn('kch', function ($query) {
				$query->from('cj_zxscj')
					->whereXh(Auth::user()->xh)
					->where('xf', '>', 0)
					->select('kch');
			})
			->get();
		$title = "学分转换申请";

		return view('xfzh.create', compact('studied_courses', 'courses', 'title'));
	}

	public function store(Request $request) {

	}

	public function delete(Request $request, $id) {

	}
}
