<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 显示并处理教学计划
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class PlanController extends Controller
{
    
	/**
	 * 显示教学计划
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 教学计划列表
	 */
	public function index() {
		$plans=Plan::whereNj(Profile::whereXh(Auth::user()->xh)->nj)
		->whereZy(Profile::whereXh(Auth::user()->xh)->zy)
		->whereZsjj(Profile::whereXh(Auth::user()->xh)->zsjj)
		->get()

		return view('plan.index')->withTitle('教学计划')->withPlans($plans);
	}
}
