<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Selcourse;
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
	 * @date    2016-01-23
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 毕业要求列表
	 */
	public function index() {
		$types = ['TB', 'KB', 'JB', 'SB', 'ZB', 'TW', 'TI', 'TY', 'TQ', 'KX', 'JX', 'ZX'];

		// 获取毕业要求学分
		$credits    = Requirement::credits(Auth::user())->get();
		$graduation = array_fill_keys($types, 0);
		foreach ($credits as $credit) {
			$graduation[$credit->pt . $credit->xz] = $credit->xf;
		}

		// 获取已选课程学分
		$credits  = Selcourse::selectedCredits(Auth::user())->get();
		$selected = array_fill_keys($types, 0);
		foreach ($credits as $credit) {
			$selected[$credit->pt . $credit->xz] = $credit->xf;
		}

		// 获取已修读学分
		$credits = Score::studiesCredits(Auth::user())->get();
		$studied = array_fill_keys($types, 0);
		foreach ($credits as $credit) {
			$studied[$credit->pt . $credit->xz] = $credit->xf;
		}

		return view('requirement.index')
			->withTitle('毕业要求')
			->withGraduation($graduation)
			->withSelected($selected)
			->withStudied($studied);
	}
}
