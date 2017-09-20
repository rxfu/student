<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Score;
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

		// 获取毕业要求学分
		$graduation = Requirement::credits(Auth::user())->get();

		// 获取已选课程学分
		$selected = Selcourse::selectedCredits(Auth::user())->get();

		// 获取已修读学分
		$studied = Score::studiedCredits(Auth::user())->get();

		$credits = [];
		foreach ($graduation as $item) {
			if ('B' == $item->xz) {
				$credits['B'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => $item->xf,
				];
			} else {
				$credits['X'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => $item->xf,
				];
			}
		}

		foreach ($selected as $item) {
			if ('Z' == $item->pt) {
				$item->pt = 'J';
			}

			if ('B' == $item->xz) {
				$credits['B'][$item->pt . $item->xz]['selected'] = $item->xf;
			} else {
				$credits['X'][$item->pt . $item->xz]['selected'] = $item->xf;
			}
		}

		foreach ($studied as $item) {
			if ('Z' == $item->pt) {
				$item->pt = 'J';
			}

			if ('R' != $item->kcxz) {
				if ('B' == $item->kcxz) {
					$credits['B'][$item->pt . $item->kcxz]['studied'] = $item->xf;
				} else {
					$credits['X'][$item->pt . $item->kcxz]['studied'] = $item->xf;
				}
			}
		}

		$title = '毕业要求';

		return view('requirement.index', compact('title', 'credits'));
	}
}
