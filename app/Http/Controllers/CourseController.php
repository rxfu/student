<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Mjcourse;
use App\Models\Plan;
use App\Models\Score;
use App\Models\Selcourse;
use Auth;
use Yajra\Datatables\Datatables;

/**
 * 显示并处理课程信息
 *
 * @author FuRongxin
 * @date 2016-01-20
 * @version 2.0
 */
class CourseController extends Controller {

	/**
	 * 显示课程信息
	 * @author FuRongxin
	 * @date    2016-01-20
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 课程信息列表
	 */
	public function index() {
		return view('course.index')->withTitle('课程基本信息');
	}

	/**
	 * 显示专业课程信息列表
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 专业课程信息
	 */
	public function major() {
		$courses = Mjcourse::whereNd(session('year'))
			->whereXq(session('term'))
			->whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->get();

		return view('course.major')->withTitle('本学期专业课程表')->withCourses($courses);
	}

	/**
	 * 列出课程信息
	 * @author FuRongxin
	 * @date    2016-02-04
	 * @version 2.0
	 * @return  JSON 课程信息列表
	 */
	public function listing() {
		$courses = Course::whereZt(config('constants.status.enable'))
			->orderBy('kch', 'asc')
			->select('kch', 'kcmc', 'kcywmc', 'xf', 'xs', 'jc');

		return Datatables::of($courses)->make(true);
	}

	/**
	 * 列出选课情况交叉比较信息
	 * @author FuRongxin
	 * @date    2016-05-13
	 * @version 2.1
	 * @return  \Illuminate\Http\Response 选课交叉比较信息
	 */
	public function match() {
		$credits        = [];
		$plan_total     = 0;
		$selected_total = 0;
		$score_total    = 0;

		// 获取教学计划学分
		$plans = Plan::with(['course' => function ($query) {
			$query->select('kch', 'kcmc', 'kcywmc');
		}])
			->whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->whereZsjj(Auth::user()->profile->zsjj)
			->orderBy('kch', 'asc')
			->get();

		foreach ($plans as $plan) {
			$credits[$plan->kch] = [
				'kch'             => $plan->kch,
				'kcmc'            => $plan->course->kcmc,
				'pt'              => $plan->platform->mc,
				'xz'              => $plan->property->mc,
				'plan_credit'     => $plan->zxf,
				'selected_credit' => 0,
				'score_credit'    => 0,
			];

			$plan_total += $plan->zxf;
		}

		// 获取选课学分
		$selects = Selcourse::with(['course' => function ($query) {
			$query->select('kch', 'kcmc', 'kcywmc');
		}])
			->whereXh(Auth::user()->xh)
			->orderBy('kch', 'asc')
			->get();

		foreach ($selects as $select) {
			if (array_key_exists($select->kch, $credits)) {
				$credits[$select->kch]['selected_credit'] = $select->xf;
			} else {
				$credits[$select->kch] = [
					'kch'             => $select->kch,
					'kcmc'            => $select->course->kcmc,
					'pt'              => $select->platform->mc,
					'xz'              => $select->property->mc,
					'plan_credit'     => 0,
					'selected_credit' => $select->xf,
					'score_credit'    => 0,
				];
			}

			$selected_total += $select->xf;
		}

		// 获取成绩学分
		$scores = Score::with(['course' => function ($query) {
			$query->select('kch', 'kcmc', 'kcywmc');
		}])
			->whereXh(Auth::user()->xh)
			->orderBy('kch', 'asc')
			->get();

		foreach ($scores as $score) {
			if (array_key_exists($score->kch, $credits)) {
				$credits[$score->kch]['score_credit'] = $score->xf;
			} else {
				$credits[$score->kch] = [
					'kch'             => $score->kch,
					'kcmc'            => $score->course->kcmc,
					'pt'              => $score->platform->mc,
					'xz'              => $score->property->mc,
					'plan_credit'     => 0,
					'selected_credit' => 0,
					'score_credit'    => $score->xf,
				];
			}

			$score_total += $score->xf;
		}

		$title = '选课学分交叉对比表';

		return view('course.match', compact('title', 'credits', 'plan_total', 'selected_total', 'score_total'));
	}
}
