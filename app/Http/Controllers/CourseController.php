<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Mjcourse;
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
}
