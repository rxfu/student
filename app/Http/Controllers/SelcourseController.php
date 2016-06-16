<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Campus;
use App\Models\Count;
use App\Models\Department;
use App\Models\Lmtgeneral;
use App\Models\Lmttime;
use App\Models\Major;
use App\Models\Mjcourse;
use App\Models\Prior;
use App\Models\Profile;
use App\Models\Pubsport;
use App\Models\Selcourse;
use App\Models\Setting;
use App\Models\Timetable;
use App\Models\Unpaid;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
		$courses    = [];

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
					$courses[$i][$timetable->zc]['rend'] = $courses[$i][$timetable->zc]['rbeg'] - 1;
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
		$courses    = [];

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
	 * @param   \Illuminate\Http\Request $request 检索请求
	 * @return  \Illuminate\Http\Response 课程检索框
	 */
	public function showSearchForm(Request $request) {
		$inputs  = $request->all();
		$search  = isset($inputs['searched']) ? $inputs['searched'] : false;
		$grade   = isset($inputs['nj']) ? $inputs['nj'] : 'all';
		$college = isset($inputs['xy']) ? $inputs['xy'] : 'all';
		$major   = isset($inputs['zy']) ? $inputs['zy'] : 'all';
		$keyword = isset($inputs['keyword']) ? $inputs['keyword'] : '';
		$type    = isset($inputs['type']) ? $inputs['type'] : '';

		$campuses = Campus::all()->each(function ($campus) {
			if (empty($campus->dm)) {
				$campus->dm = 'unknown';
				$campus->mc = '未知';
			}
		});

		$grades = Mjcourse::whereNd(session('year'))
			->whereXq(session('term'))
			->where('nj', '<>', '')
			->select('nj')
			->distinct()
			->orderBy('nj')
			->get();

		$colleges = Department::colleges()
			->where('mc', '<>', '')
			->select('dw', 'mc')
			->orderBy('dw')
			->get();

		$majors = Major::whereZt(config('constants.status.enable'))
			->where('mc', '<>', '')
			->select('zy', 'mc', 'xy')
			->orderBy('zy')
			->get();

		return view('selcourse.search')
			->withTitle('课程检索')
			->withInfo('请输入课程序号或课程中文名称进行检索')
			->withCampuses($campuses)
			->withGrades($grades)
			->withColleges($colleges)
			->withMajors($majors)
			->withSearch($search)
			->withSgrade($grade)
			->withScollege($college)
			->withSmajor($major)
			->withKeyword($keyword)
			->withType($type);
	}

	/**
	 * 检索课程
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   \Illuminate\Http\Request $request 检索请求
	 * @param   string $campus 校区号
	 * @return  \Illuminate\Http\Response 检索结果
	 */
	public function search(Request $request, $campus) {
		$this->validate($request, [
			'nj' => 'required',
			'xy' => 'required',
			'zy' => 'required',
		]);

		$inputs = $request->all();

		$courses = Mjcourse::ofGrade($inputs['nj'])
			->ofCollege($inputs['xy'])
			->ofMajor($inputs['zy'])
			->selectable($campus)
			->exceptGeneral();

		if (!empty(trim($inputs['keyword']))) {
			switch ($inputs['type']) {
			case 'kcxh':
				$courses = $courses->where('pk_kczy.kcxh', 'like', '%' . $inputs['keyword'] . '%');
				break;

			case 'kcmc':
				$courses = $courses->where('jx_kc.kcmc', 'like', '%' . $inputs['keyword'] . '%');
				break;

			default:
				$courses = $courses->where('pk_kczy.kcxh', 'like', '%' . $inputs['keyword'] . '%');
				break;
			}
		}

		$courses->get();

		$datatable = Datatables::of($courses)
			->addColumn('retake', function ($course) {
				return '<a href="' . route('application.create', ['type' => 'retake', 'kcxh' => $course->kcxh]) . '" title="申请重修" class="btn btn-warning">申请重修</a>';
			});

		$datatable = $datatable->addColumn('other', function ($course) {
			return '<a href="' . route('application.create', ['type' => 'other', 'kcxh' => $course->kcxh]) . '" title="申请修读" class="btn btn-primary">申请修读</a>';
		});

		for ($i = 1; $i <= 7; ++$i) {
			$datatable = $datatable->addColumn($this->_weeks[$i], function ($course) use ($i) {
				$info = '';

				foreach (array_keys(explode(',', $course->zcs), $i) as $pos) {
					$ksz  = array_get(explode(',', $course->kszs), $pos);
					$jsz  = array_get(explode(',', $course->jszs), $pos);
					$ksj  = array_get(explode(',', $course->ksjs), $pos);
					$jsj  = array_get(explode(',', $course->jsjs), $pos);
					$jsxm = array_get(explode(',', $course->jsxms), $pos);

					$info .= '<p><div>第 ';
					$info .= ($ksz === $jsz) ? $ksz : $ksz . ' ~ ' . $jsz;
					$info .= ' 周</div><div class="text-danger">第 ';
					$info .= ($ksj === $jsj) ? $ksj : $ksj . ' ~ ' . $jsj;
					$info .= ' 节</div><div class="text-info">';
					$info .= empty($jsxm) ? '未知老师' : $jsxm;
					$info .= '</div></p>';
				}

				return $info;
			});
		}

		return $datatable->make(true);
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
	 * 保存所选课程
	 * @author FuRongxin
	 * @date 2016-06-16
	 * @version 2.1
	 * @param  \Illuminate\Http\Request  $request 保存请求
	 * @return \Illuminate\Http\Response 选课列表
	 */
	public function store(Request $request) {
		if ('pubsport' == $request->input('type')) {
			if (config('constants.status.disable') == Setting::find('XK_GT')->value) {
				abort(403, '现在未开放公体选课，不允许公体选课');
			}
		} elseif (config('constants.status.disable') == Setting::find('XK_KG')->value) {
			abort(403, '现在未开放选课，不允许选课');
		}

		if (Unpaid::whereXh(Auth::user()->xh)->exists()) {
			abort(403, '请交清费用再进行选课');
		}

		if ('pubsport' != $request->input('type')) {
			if (config('constants.status.enable') == Setting::find('XK_SJXZ')->value) {
				$profile = Profile::whereXh(Auth::user()->xh)
					->select('nj', 'xz')
					->firstOrFail();

				// 未在时间限制表中配置，默认不允许选课
				$now    = Carbon::now();
				$exists = Lmttime::whereNj($profile->nj)
					->whereXz($profile->xz)
					->where('kssj', '<', $now)
					->where('jssj', '>', $now)
					->exists();

				if (!$exists) {
					abort(403, '现在未到选课时间，不允许选课');
				}
			}
		}

		if ($request->isMethod('post')) {
			$this->validate($request, [
				'kcxh' => 'required|alpha_num|size:12',
			]);

			$inputs = $request->all();

			if (in_array($inputs['type'], array_keys(config('constants.course.general')))) {
				if (config('constants.stauts.disable') == Setting::find('XK_TS')->value) {
					abort(403, '现在未开放通识素质课选课，不允许选课');
				}

				if (config('constants.status.enable') == Setting::find('XK_TSXZ')->value) {
					$profile = Profile::whereXh(Auth::user()->xh)
						->select('nj', 'xz')
						->firstOrFail();

					// 未在时间限制表中配置，默认不允许选通识素质课
					$now   = Carbon::now();
					$limit = Lmtgeneral::whereNj($profile->nj)
						->whereXz($profile->xz)
						->where('kssj', '<', $now)
						->where('jssj', '>', $now)
						->orderBy('kssj', 'desc')
						->first();

					if (!$limit) {
						abort(403, '现在未到通识素质课选课时间，不允许选课');
					}

					$limit_course = $limit->ms;
					$limit_ratio  = 0 < $limit->bl ? $limit->bl / 100 : $limit->bl;
				}
			} else {
				$limit_ratio = 1;
			}

			$course = Mjcourse::ofType($inputs['type'])
				->whereNd(session('year'))
				->whereXq(session('term'))
				->whereZsjj(session('season'))
				->whereKcxh($inputs['kcxh'])
				->firstOrFail();

			$ms     = isset($limit_course) ? $limit_course : -1;
			$rs     = isset($limit_ratio) ? $limit_ratio * $course->rs : -1;
			$limits = $this->checkcourse($inputs['type'], $course->kcxh, $course->zy, $ms, $rs);

			if ($limits['ms']) {
				$request->session()->flash('forbidden', '通识素质课选课门数已达上限' . $ms . '门，请选其他课程');
				return back()->withInput();
			}

			if ($limits['rs']) {
				$request->session()->flash('forbidden', '选课人数已满，请选其他课程');
				return back()->withInput();
			}

			if (Prior::failed(Helper::getCno($course->kcxh), Auth::user())->exists()) {
				$request->session()->flash('forbidden', '前修课未修读');
				return back()->withInput();
			}

			$selcourse        = new Selcourse;
			$selcourse->xh    = Auth::user()->xh;
			$selcourse->xm    = Auth::user()->profile->xm;
			$selcourse->nd    = $course->nd;
			$selcourse->xq    = $course->xq;
			$selcourse->kcxh  = $inputs['kcxh'];
			$selcourse->kch   = Helper::getCno($inputs['kcxh']);
			$selcourse->pt    = $course->pt;
			$selcourse->xz    = $course->xz;
			$selcourse->xl    = $course->xl;
			$selcourse->jsgh  = $course->timetables()->first()->jsgh;
			$selcourse->xf    = $course->plan->zxf;
			$selcourse->sf    = config('constants.status.enable');
			$selcourse->zg    = $course->bz;
			$selcourse->cx    = config('constants.status.disable');
			$selcourse->bz    = config('constants.status.disable');
			$selcourse->sj    = Carbon::now();
			$selcourse->kkxy  = $course->kkxy;
			$selcourse->qz    = 0;
			$selcourse->tdkch = '';
			$selcourse->tdyy  = '';
			$selcourse->zy    = $course->zy;

			if ($selcourse->save()) {
				return redirect()->route('selcourse.show', $inputs['type'])->withStatus('选课成功');
			} else {
				return back()->withInput()->withStatus('选课失败');
			}
		}
	}

	/**
	 * 选课时间冲突检测
	 * @author FuRongxin
	 * @date    2016-03-02
	 * @version 2.0
	 * @param   string $kcxh 12位课程序号
	 * @return  array 冲突返回冲突的课程序号，否则返回空数组
	 */
	public function checktime($kcxh) {
		$currents = Timetable::whereNd(session('year'))
			->whereXq(session('term'))
			->whereKcxh($kcxh)
			->get();
		$selcourses = Selcourse::with('timetables')
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereXh(Auth::user()->xh)
			->get();

		foreach ($currents as $current) {
			foreach ($selcourses as $selcourse) {
				foreach ($selcourse->timetables as $compare) {
					if ($current->zc == $compare->zc) {
						if ($current->ksj >= $compare->ksj && $current->ksj <= $compare->jsj) {
							if ($current->ksz >= $compare->ksz && $current->ksz <= $compare->jsz) {
								$conflicts[] = $compare['kcxh'];
							}
						}
					}
				}
			}
		}

		$conflicts = isset($conflicts) ? array_unique($conflicts) : [];

		return request()->ajax() ? response()->json($conflicts) : $conflicts;
	}

	/**
	 * 选课门数和人数限制检测
	 * 2016-06-16：添加专业号检测
	 * @author FuRongxin
	 * @date    2016-06-16
	 * @version 2.1
	 * @param   string $type 课程类型
	 * @param   string $kcxh 12位课程序号
	 * @param   string $zy 专业号
	 * @param   integer $ms 课程门数限制，-1为无限制
	 * @param   integer $rs 选课人数限制，-1为无限制
	 * @return  array 课程门数和人数限制标志数组，true为超限，false为未超限
	 */
	public function checkcourse($type, $kcxh, $zy, $ms = -1, $rs = -1) {
		$limits = [
			'ms' => false,
			'rs' => false,
		];
		if (in_array($type, array_keys(config('constants.course.general')))) {
			if (-1 < $ms) {
				$count = Selcourse::ofType($type)
					->whereNd(session('year'))
					->whereXq(session('term'))
					->whereXh(Auth::user()->xh)
					->count();

				if ($count >= $ms) {
					$limits['ms'] = true;
				}
			}

			if (-1 < $rs) {
				$course = Count::whereKcxh($kcxh)->first();
				$count  = isset($course) ? $course->rs : 0;

				if ($count >= $rs) {
					$limits['rs'] = true;
				}
			}
		} else {
			$course = Count::whereKcxh($kcxh)->whereZy($zy)->first();
			$count  = isset($course) ? $course->rs : 0;

			if ($count >= $rs) {
				$limits['rs'] = true;
			}
		}

		return request()->ajax() ? response()->json($limits) : $limits;
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
		if ('pubsport' == $type) {
			if (config('constants.status.disable') == Setting::find('XK_GT')->value) {
				abort(403, '现在未开放公体选课，不允许公体选课');
			}
		} elseif (config('constants.status.disable') == Setting::find('XK_KG')->value) {
			abort(403, '现在未开放选课，不允许选课');
		}

		if (Unpaid::whereXh(Auth::user()->xh)->exists()) {
			abort(403, '请交清费用再进行选课');
		}

		if ('pubsport' != $type) {
			if (config('constants.status.enable') == Setting::find('XK_SJXZ')->value) {
				$profile = Profile::whereXh(Auth::user()->xh)
					->select('nj', 'xz')
					->firstOrFail();

				// 未在时间限制表中配置，默认不允许选课
				$now    = Carbon::now();
				$exists = Lmttime::whereNj($profile->nj)
					->whereXz($profile->xz)
					->where('kssj', '<', $now)
					->where('jssj', '>', $now)
					->exists();

				if (!$exists) {
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
					->firstOrFail();

				// 未在时间限制表中配置，默认不允许选通识素质课
				$now    = Carbon::now();
				$exists = Lmtgeneral::whereNj($profile->nj)
					->whereXz($profile->xz)
					->where('kssj', '<', $now)
					->where('jssj', '>', $now)
					->exists();

				if (!$exists) {
					abort(403, '现在未到通识素质课选课时间，不允许选课');
				}
			}

			$type_name = config('constants.course.general.' . $type . '.name');
		}

		$type_name = isset($type_name) ? $type_name : config('constants.course.' . $type . '.name');

		$campuses = Campus::all()->each(function ($course) {
			if (empty($course->dm)) {
				$course->dm = 'unknown';
				$course->mc = '未知';
			}
		});

		return view('selcourse.show')->withTitle($type_name . '选课表')->withType($type)->withCampuses($campuses);
	}

	/**
	 * 按校区列出可选课程
	 * 2016-05-12：应教务处要求，添加公体选课类别名称
	 * @author FuRongxin
	 * @date    2016-05-12
	 * @version 2.1
	 * @param   string $type 课程类型
	 * @param   string $campus 校区号
	 * @return  JSON 可选课程列表
	 */
	public function listing($type, $campus) {
		$courses = Mjcourse::ofType($type)
			->selectable($campus)
			->get();

		$datatable = Datatables::of($courses)
			->addColumn('action', function ($course) use ($type) {
				$same = Selcourse::whereXh(Auth::user()->xh)
					->whereNd(session('year'))
					->whereXq(session('term'))
					->whereKch($course->kch)
					->where('kcxh', '<>', $course->kcxh)
					->exists();

				$exists = Selcourse::whereXh(Auth::user()->xh)
					->whereNd(session('year'))
					->whereXq(session('term'))
					->whereKcxh($course->kcxh)
					->exists();

				if ($exists) {
					return '<form name="deleteForm" action="' . route('selcourse.destroy', $course->kcxh) . '" method="post" role="form" data-id="' . $course->kcxh . '" data-name="' . $course->kcmc . '">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger">退课</button></form>';
				} elseif ($same) {
					return '<div class="text-danger">已选同号课程</div>';
				} elseif (Prior::failed($course->kch, Auth::user())->exists()) {
					return '<div class="text-danger">前修课未修读</div>';
				} elseif ($course->rs >= $course->zrs) {
					return '<div class="text-danger">人数已满</div>';
				} else {
					return '<form name="createForm" action="' . route('selcourse.store') . '" method="post" role="form" data-id="' . $course->kcxh . '" data-name="' . $course->kcmc . '">' . csrf_field() . '<button type="submit" class="btn btn-primary">选课</button><input type="hidden" name="kcxh" value="' . $course->kcxh . '"><input type="hidden" name="type" value="' . $type . '"></form>';
				}
			})
			->editColumn('kcmc', function ($course) use ($type) {

				// 列出公体项目名称
				if ('pubsport' == $type) {
					$sport = Pubsport::whereNd(session('year'))
						->whereXq(session('term'))
						->whereKcxh($course->kcxh)
						->first();

					if (is_object($sport)) {
						return $course->kcmc . '-' . $sport->xm;
					}
				}

				return $course->kcmc;
			});

		for ($i = 1; $i <= 7; ++$i) {
			$datatable = $datatable->addColumn($this->_weeks[$i], function ($course) use ($i) {
				$info = '';

				foreach (array_keys(explode(',', $course->zcs), $i) as $pos) {
					$ksz  = array_get(explode(',', $course->kszs), $pos);
					$jsz  = array_get(explode(',', $course->jszs), $pos);
					$ksj  = array_get(explode(',', $course->ksjs), $pos);
					$jsj  = array_get(explode(',', $course->jsjs), $pos);
					$jsxm = array_get(explode(',', $course->jsxms), $pos);

					$info .= '<p><div>第 ';
					$info .= ($ksz === $jsz) ? $ksz : $ksz . ' ~ ' . $jsz;
					$info .= ' 周</div><div class="text-danger">第 ';
					$info .= ($ksj === $jsj) ? $ksj : $ksj . ' ~ ' . $jsj;
					$info .= ' 节</div><div class="text-info">';
					$info .= empty($jsxm) ? '未知老师' : $jsxm;
					$info .= '</div></p>';
				}

				return $info;
			});
		}

		return $datatable->make(true);
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
