<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Selcourse;
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
		$selcourses = Selcourse::selectedCourses(Auth::user())->get();

		foreach ($selcourses as $selcourse) {
			foreach ($selcourse->timetables as $timetable) {

				// 生成课程序号为索引的课程信息数组
				if (!isset($courses[$selcourse->kcxh])) {
					$courses[$selcourse->kcxh] = [
						'kcxh' => $selcourse->kcxh,
						'kcmc' => $selcourse->course->kcmc,
						'xf'   => $selcourse->xf,
						'xqh'  => $timetable->campus->mc,
					];
				}

				// 在课程信息数组下生成周次为索引的课程时间数组
				$courses[$selcourse->kcxh][$timetable->zc][] = [
					'ksz'  => $timetable->ksz,
					'jsz'  => $timetable->jsz,
					'ksj'  => $timetable->ksj,
					'jsj'  => $timetable->jsj,
					'js'   => $timetable->classroom->mc,
					'jsxm' => $timetable->teacher->xm,
					'zc'   => $timetable->teacher->position->mc,
				];
			}
		}

		return view('selcourse.index')->withTitle('当前选课课程列表')->withCourses($courses);
	}

	/**
	 * 显示学生课程表
	 * @author FuRongxin
	 * @date    2016-02-16
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 课程表
	 */
	public function timetable() {
		$selcourses = Selcourse::selectedCourses(Auth::user())->get();
		$periods    = config('constants.timetable');

		// 初始化课程数组
		$courses = [];
		for ($i = $periods['morning']['begin']; $i <= $periods['evening']['end']; ++$i) {
			for ($j = 1; $j <= 7; ++$j) {
				$courses[$i][$j]['rbeg'] = $courses[$i][$j]['rend'] = $i;
			}
		}

		// 遍历已选课程
		foreach ($selcourses as $selcourse) {

			// 获取课程时间
			foreach ($selcourse->timetables as $timetable) {

				// 课程时间没有冲突
				$courses[$timetable->ksj][$timetable->zc]['conflict'] = false;
				$courses[$timetable->ksj][$timetable->zc]['rbeg']     = $timetable->ksj;
				$courses[$timetable->ksj][$timetable->zc]['rend']     = $timetable->jsj;

				for ($i = $timetable->ksj + 1; $i <= $timetable->jsj; ++$i) {
					$courses[$i][$timetable->zc]['rend'] -= 1;
				}

				// 获取课程所在时间段
				foreach ($periods as $values) {
					if ($timetable->ksj >= $values['begin'] && $timetable->jsj <= $values['end']) {
						$id = $values['id'];
						break;
					}
				}

				// 检测课程时间冲突
				for ($i = $timetable->ksj; $i >= $periods[$id]['begin']; --$i) {

					// 只获取课程数组
					if (!empty($classes = array_filter($courses[$i][$timetable->zc], function ($v) {return is_array($v);}))) {
						foreach ($classes as $course) {

							// 判断开始周或结束周是否在其他课程开始周和结束周之间
							if ($timetable->ksz >= $course['ksz'] && $timetable->ksz <= $course['jsz'] || $timetable->jsz >= $course['ksz'] && $timetable->jsz <= $course['jsz']) {

								// 判断开始节是否在其它课程开始节和结束节之间
								if ($timetable->ksj >= $course['ksj'] && $timetable->ksj <= $course['jsj']) {

									// 设置冲突标志，修改表格行起止行数
									$courses[$timetable->ksj][$timetable->zc]['conflict'] = true;
									$courses[$timetable->ksj][$timetable->zc]['rbeg']     = $timetable->ksj;
									$courses[$timetable->ksj][$timetable->zc]['rend']     = min($timetable->jsj, $course['jsj']);

									// 修改冲突课程结束行数
									$courses[$i][$timetable->zc]['rend'] = $timetable->ksj;

									// 设置新行
									$courses[$courses[$timetable->ksj][$timetable->zc]['rend']][$timetable->zc]['rbeg'] = $courses[$timetable->ksj][$timetable->zc]['rend'];
									$courses[$courses[$timetable->ksj][$timetable->zc]['rend']][$timetable->zc]['rend'] = max($timetable->jsj, $course['jsj']);
								}
							}
						}
					}
				}

				// 生成开始节、周次为索引的课程数组
				$courses[$timetable->ksj][$timetable->zc][] = [
					'kcxh' => $selcourse->kcxh,
					'kcmc' => $selcourse->course->kcmc,
					'xqh'  => $timetable->campus->mc,
					'ksz'  => $timetable->ksz,
					'jsz'  => $timetable->jsz,
					'ksj'  => $timetable->ksj,
					'jsj'  => $timetable->jsj,
					'js'   => $timetable->classroom->mc,
					'jsxm' => $timetable->teacher->xm,
					'zc'   => $timetable->teacher->position->mc,
				];
			}
		}

		return view('selcourse.timetable')
			->withTitle('当前课程表')
			->withCourses($courses)
			->withPeriods($periods);
	}

	/**
	 * 可退选课程表
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 可退选课程表
	 */
	public function deletable() {
		$selcourses = Selcourse::selectedCourses(Auth::user())->get();

		foreach ($selcourses as $selcourse) {
			foreach ($selcourse->timetables as $timetable) {

				// 生成课程序号为索引的课程信息数组
				if (!isset($courses[$selcourse->kcxh])) {
					$courses[$selcourse->kcxh] = [
						'kcxh' => $selcourse->kcxh,
						'kcmc' => $selcourse->course->kcmc,
						'xf'   => $selcourse->xf,
						'xqh'  => $timetable->campus->mc,
					];
				}

				// 在课程信息数组下生成周次为索引的课程时间数组
				$courses[$selcourse->kcxh][$timetable->zc][] = [
					'ksz'  => $timetable->ksz,
					'jsz'  => $timetable->jsz,
					'ksj'  => $timetable->ksj,
					'jsj'  => $timetable->jsj,
					'js'   => $timetable->classroom->mc,
					'jsxm' => $timetable->teacher->xm,
					'zc'   => $timetable->teacher->position->mc,
				];
			}
		}

		return view('selcourse.deletable')->withTitle('可退选课程列表')->withCourses($courses);
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
	 * 退选课程
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   string $kcxh 12位课程序号
	 * @return  \Illuminate\Http\Response 课程表
	 */
	public function destroy($kcxh) {
		//
	}
}
