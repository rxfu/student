<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Selcourse;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;

/**
 * 显示并处理选课信息
 *
 * @author FuRongxin
 * @date 2016-02-15
 * @version 2.0
 */
class SelcourseController extends Controller {

	/**
	 * 显示学生选课信息列表
	 * @author FuRongxin
	 * @date    2016-02-15
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 选课信息列表
	 */
	public function index() {
		$selcourses = Selcourse::with(['timetables.classroom', 'timetables.campus', 'timetables.teacher', 'timetables' => function ($query) {
			$query->select('kcxh', 'ksz', 'jsz', 'zc', 'ksj', 'jsj', 'cdbh', 'xqh', 'jsgh');
		}])
			->with(['course' => function ($query) {
				$query->select('kch', 'kcmc');
			}])
			->whereXh(Auth::user()->xh)
			->whereNd(Setting::find('XK_ND')->value)
			->whereXq(Setting::find('XK_XQ')->value)
			->orderBy('kcxh', 'asc')
			->get();

		foreach ($selcourses as $selcourse) {
			foreach ($selcourse->timetables as $timetable) {
				if (isset($courses[$selcourse->kcxh])) {
					$courses[$selcourse->kcxh][$timetable->zc] = '第 ' . $timetable->ksj . '~' . $timetable->jsj . ' 节<br>' . $timetable->classroom->mc . '教室<br>' . $timetable->teacher->xm;
				} else {
					$courses[$selcourse->kcxh] = [
						'kcxh'         => $selcourse->kcxh,
						'kcmc'         => $selcourse->course->kcmc,
						'xf'           => $selcourse->xf,
						'xqh'          => $timetable->campus->mc,
						'ksz'          => $timetable->ksz,
						'jsz'          => $timetable->jsz,
						$timetable->zc => '第 ' . $timetable->ksj . '~' . $timetable->jsj . ' 节<br>' . $timetable->classroom->mc . '教室<br>' . $timetable->teacher->xm,
					];
				}
			}
		}

		return view('selcourse.index')->withTitle('当前选课课程列表')->withCourses($courses);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
