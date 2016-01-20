<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;

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
}
