<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Auth;

/**
 * 显示并处理教学计划
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class PlanController extends Controller {

	/**
	 * 显示教学计划
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 教学计划列表
	 */
	public function index() {
		$plans = Plan::whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->whereZsjj(Auth::user()->profile->zsjj)
			->get();

		return view('plan.index')->withTitle('教学计划')->withPlans($plans);
	}
}
