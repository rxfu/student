<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Lmttime;
use App\Models\Mjcourse;
use App\Models\Profile;
use App\Models\Selcourse;
use App\Models\Setting;
use App\Models\Timetable;
use App\Models\Unpaid;
use Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

/**
 * 显示并处理选课信息
 *
 * @author FuRongxin
 * @date 2016-02-15
 * @version 2.0
 */
class SelcourseController extends Controller {

	private $_weeks = [
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday',
		7 => 'Sunday',
	];

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
	 * 显示课程检索表单
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 课程检索框
	 */
	public function showSearchForm() {
		return view('selcourse.search')->withTitle('课程检索')->withInfo('请输入课程序号或课程中文名称进行检索');
	}

	/**
	 * 检索课程
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   \Illuminate\Http\Request $request 检索请求
	 * @return  \Illuminate\Http\Response 检索结果
	 */
	public function search(Request $request) {

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
	 * 显示可选课程列表
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   string $type 课程类型
	 * @return  \Illuminate\Http\Response 可选课程列表
	 */
	public function show($type) {
		if (config('constants.status.disable') == Setting::find('XK_KG')->value) {
			abort(403, '现在未开放选课，不允许选课');
		}

		if (Unpaid::whereXh(Auth::user()->xh)->exists()) {
			abort(403, '请交清费用再进行选课');
		}

		if (config('constants.status.enable') == Setting::find('XK_SJXZ')->value) {
			$profile = Profile::whereXh(Auth::user()->xh)
				->select('nj', 'xz')
				->first();
			$limit = Lmttime::whereNj($profile->nj)
				->whereXz($profile->xz)
				->first();

			if (!empty($limit)) {
				$now = date('Y-m-d H:i:s');

				if ($now < $limit->kssj || $now > $limit->jssj) {
					abort(403, '现在未到选课时间，不允许选课');
				}
			}
		}

		if (in_array($type, array_keys(config('constants.course.general')))) {
			if (config('constants.stauts.disable') == Setting::find('XK_TS')->value) {
				abort(403, '现在未开放通识素质课选课，不允许选课');
			}

			if (config('constants.status.enable') == Setting::find('XK_TSXZ')->value) {
				$profile = Profile::whereXh(Auth::user()->xh)
					->select('nj', 'xz')
					->first();
				$limit = Lmttime::whereNj($profile->nj)
					->whereXz($profile->xz)
					->first();

				if (!empty($limit)) {
					$now = date('Y-m-d H:i:s');

					if ($now < $limit->kssj || $now > $limit->jssj) {
						abort(403, '现在未到通识素质课选课时间，不允许选课');
					} else {
						$limit_course = $limit->ms;
						$limit_ratio  = $limit->bl / 100;
					}
				}
			}
		}

		return view('selcourse.show')->withTitle('选课表')->withType($type)->withCampuses(Campus::all());
	}

	public function listing($type, $campus) {
		$selectables = Mjcourse::ofType($type)
			->selectable($campus)
			->get();

		$courses = [];
		foreach ($selectables as $course) {

			// 生成课程序号为索引的课程信息数组
			if (!isset($courses[$course->kcxh])) {
				$courses[$course->kcxh] = [
					'kcxh' => $course->kcxh,
					'kcmc' => $course->kcmc,
					'xf'   => $course->zxf,
					'xqh'  => $course->xqh,
					'xqmc' => $course->xqmc,
					'zrs'  => $course->zrs,
					'rs'   => $course->rs,
					'kh'   => $course->kh,
				];
			}

			// 在课程信息数组下生成周次为索引的课程时间数组
			$courses[$course->kcxh][$course->zc][] = [
				'ksz'  => $course->ksz,
				'jsz'  => $course->jsz,
				'ksj'  => $course->ksj,
				'jsj'  => $course->jsj,
				'jsxm' => $course->jsxm,
			];
		}

		if (empty($courses)) {
			return response()->json(['data' => $courses]);
		} else {
			$datatable = Datatables::of($courses)
				->addColumn('action', function ($course) {
					return '<form id="deleteForm" name="deleteForm" action="' . route('selcourse.destroy', $course['kcxh']) . '" method="post" role="form">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger">退课</button></form>';
				});

			for ($i = 1; $i <= 7; ++$i) {
				$datatable = $datatable->addColumn($this->_weeks[$i], function ($course) {
					$info = '';
					foreach ($course[$i] as $class) {
						$info .= '<p><div>第 ';
						$info .= ($class['ksz'] === $class['jsz']) ? $class['ksz'] : $class['ksz'] . ' ~ ' . $class['jsz'];
						$info .= ' 周</div><div class="text-danger"><strong>第 ';
						$info .= ($class['ksj'] === $class['jsj']) ? $class['ksj'] : $class['ksj'] . ' ~ ' . $class['jsj'];
						$info .= ' 节</strong></div><div class="text-info">';
						$info .= empty($class['jsxm']) ? '未知老师' : $class['jsxm'];
						$info .= '</div></p>';
					}
					return $info;
				});
			}

			return $datatable->make(true);
		}
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
		$course = Selcourse::whereXh(Auth::user()->xh)
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereKcxh($kcxh)
			->firstOrFail();

		$course->delete();

		return back()->withStatus('退选课程成功');
	}
}
