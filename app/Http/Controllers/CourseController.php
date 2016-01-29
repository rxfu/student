<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Mjcourse;
use App\Models\Setting;
use Auth;

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
		$courses = Course::whereZt(config('constants.status.enable'))
			->orderBy('kch', 'asc')
			->get();

		return view('course.index')->withTitle('课程基本信息')->withCourses($courses);
	}

	/**
	 * 显示专业课程信息列表
	 * @author FuRongxin
	 * @date    2016-01-29
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 专业课程信息
	 */
	public function major() {
		$courses = Mjcourse::whereNd(Setting::find('XK_ND')->value)
			->whereXq(Setting::find('XK_XQ')->value)
			->whereNj(Auth::user()->profile->nj)
			->whereZy(Auth::user()->profile->zy)
			->get();

		return view('course.major')->withTitle('本学期专业课程表')->withCourses($courses);
	}
}
