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
	 * 2018-09-12：应教务处要求增加计划外获得学分显示列表
	 *
	 * @author FuRongxin
	 * @date    2018-09-12
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 毕业要求列表
	 */
	public function index() {

		// 获取毕业要求学分
		$graduation = Requirement::credits(Auth::user())->get();

		// 获取已选课程学分
		$selected = Selcourse::selectedCredits(Auth::user())->get();

		// 获取已修读学分
		$studied = Score::studiedCredits(Auth::user())->get();

		// 获取已选且未重修课程学分
		$unretake = Selcourse::selectedUnretakeCredits(Auth::user())->get();

		$credits = [];
		foreach ($graduation as $item) {
			if ('B' == $item->xz) {
				$credits['B'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => $item->xf,
					'selected'   => 0,
					'studied'    => 0,
					'unretake'   => 0,
				];
			} else {
				$credits['X'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => $item->xf,
					'selected'   => 0,
					'studied'    => 0,
					'unretake'   => 0,
				];
			}
		}

		foreach ($selected as $item) {
			if (isset($credits['B'][$item->pt . $item->xz]) || isset($credits['X'][$item->pt . $item->xz])) {
				if ('B' == $item->xz) {
					$credits['B'][$item->pt . $item->xz]['selected'] += $item->xf;
				} else {
					$credits['X'][$item->pt . $item->xz]['selected'] += $item->xf;
				}
			} else {
				$credits['O'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => 0,
					'selected'   => $item->xf,
					'studied'    => 0,
					'unretake'   => 0,
				];
			}
		}

		foreach ($studied as $item) {
			if (isset($credits['B'][$item->pt . $item->kcxz]) || isset($credits['X'][$item->pt . $item->kcxz]) || isset($credits['O'][$item->pt . $item->kcxz])) {
				if (isset($credits['O'][$item->pt . $item->kcxz])) {
					$credits['O'][$item->pt . $item->kcxz]['studied'] += $item->xf;
				} else {
					if ('B' == $item->kcxz) {
						$credits['B'][$item->pt . $item->kcxz]['studied'] += $item->xf;
					} else {
						$credits['X'][$item->pt . $item->kcxz]['studied'] += $item->xf;
					}
				}
			} else {
				$credits['O'][$item->pt . $item->kcxz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => 0,
					'selected'   => 0,
					'studied'    => $item->xf,
					'unretake'   => 0,
				];
			}
		}

		foreach ($unretake as $item) {
			if (isset($credits['B'][$item->pt . $item->xz]) || isset($credits['X'][$item->pt . $item->xz])) {
				if ('B' == $item->xz) {
					$credits['B'][$item->pt . $item->xz]['unretake'] += $item->xf;
				} else {
					$credits['X'][$item->pt . $item->xz]['unretake'] += $item->xf;
				}
			} else {
				$credits['O'][$item->pt . $item->xz] = [
					'title'      => $item->platform->mc . $item->property->mc,
					'graduation' => 0,
					'selected'   => 0,
					'studied'    => 0,
					'unretake'   => $item->xf,0,
				];
			}
		}

		$title = '毕业要求';

		return view('requirement.index', compact('title', 'credits'));
	}
}
