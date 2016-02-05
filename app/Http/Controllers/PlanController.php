<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Auth;
use Yajra\Datatables\Datatables;

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
		return view('plan.index')->withTitle('教学计划');
	}

	/**
	 * 列出教学计划
	 * @author FuRongxin
	 * @date    2016-02-04
	 * @version 2.0
	 * @return  JSON 教学计划列表
	 */
	public function listing() {
		$plans = Plan::with(['platform' => function ($query) {
			$query->select('mc');
		}])
			->with(['property' => function ($query) {
				$query->select('mc');
			}])
			->with(['course' => function ($query) {
				$query->select('kcmc', 'kcywmc');
			}])
			->with(['mode' => function ($query) {
				$query->select('mc');
			}])
			->with(['college' => function ($query) {
				$query->select('mc');
			}])
			->whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->whereZsjj(Auth::user()->profile->zsjj)
			->orderBy('kch', 'asc');

		return Datatables::of($plans)
			->addColumn('kcmc', function ($plan) {
				return $plan->course->kcmc;
			})
			->addColumn('kcywmc', function ($plan) {
				return $plan->course->kcywmc;
			})
			->addColumn('zxs', '{{ $llxs + $syxs }}')
			->editColumn('pt', function ($plan) {
				return $plan->platform->mc;
			})
			->editColumn('xz', function ($plan) {
				return $plan->property->mc;
			})
			->editColumn('kh', function ($plan) {
				return $plan->mode->mc;
			})
			->editColumn('kkxy', function ($plan) {
				return $plan->college->mc;
			})
			->make(true);
	}
}
