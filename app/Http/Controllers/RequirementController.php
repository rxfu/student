<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Selcourse;
use App\Models\Setting;
use Auth;

/**
 * 显示并处理毕业要求
 *
 * @author FuRongxin
 * @date 2016-01-21
 * @version 2.0
 */
class RequirementController extends Controller {

	/**
	 * 显示毕业要求
	 * @author FuRongxin
	 * @date    2016-01-21
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 毕业要求列表
	 */
	public function index() {
		$types = ['TB', 'KB', 'JB', 'SB', 'ZB', 'TW', 'TI', 'TY', 'TQ', 'KX', 'JX', 'ZX'];

		// 获取毕业要求学分
		$credits = Requirement::whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->whereZsjj(Auth::user()->profile->zsjj)
			->whereByfa(Auth::user()->profile->byfa)
			->get();

		$graduation = array_fill_keys($types, 0);
		foreach ($credits as $credit) {
			$graduation[$credit->pt . $credit->xz] = $credit->xf;
		}

		// 获取已选课程学分
		$credits = Selcourse::whereNd(Setting::find('XK_ND')->value)
			->whereXq(Setting::find('XK_XQ')->value)
			->whereXh(Auth::user()->xh)
			->groupBy('pt', 'xz')
			->select('pt', 'xz')
			->sum('xf');
		dd($credits);
		$selected = array_fill_keys($types, 0);
		foreach ($credits as $credit) {
			$selected[$credit->pt . $credit->xz] = $credit->xf;
		}

		return view('requirement.index')
			->withTitle('毕业要求')
			->withGraduation($graduation)
			->withSelected($selected);
	}
}
