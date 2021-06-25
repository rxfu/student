<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Application;
use App\Models\Mjcourse;
use App\Models\Selcourse;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * 显示并处理学生选课申请
 *
 * @author FuRongxin
 * @date 2016-02-23
 * @version 2.0
 */
class ApplicationController extends Controller
{

	/**
	 * 选课申请进度查询
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 选课申请进度列表
	 */
	public function index()
	{
		$apps = Application::with('term')
			->whereXh(Auth::user()->xh)
			->orderBy('xksj', 'desc')
			->get();

		return view('application.index')->withTitle('课程申请进度')->withApps($apps);
	}

	/**
	 * 显示学生选课申请表单
	 * 2017-01-02：应教务处要求，添加同课程号课程申请检测
	 * 2021-06-24：应教务处要求，添加限定学历本科生选课限制功能，即限定管理单位（gldw）
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 申请请求
	 * @return  \Illuminate\Http\Response 选课申请表单
	 */
	public function create(Request $request)
	{
		$inputs = $request->all();

		// 2018-02-09：应教务处要求，在选课申请中排除本年级本专业本学期课程
		// 2021-06-24：应教务处要求，添加限定学历本科生选课限制功能，即限定管理单位（gldw）
		$course = Mjcourse::whereNd(session('year'))
			->whereXq(session('term'))
			->whereZsjj(session('season'))
			->exceptGeneral()
			->where(function ($query) {
				$query->where('pk_kczy.nj', '<>', session('grade'))
					->orWhere('pk_kczy.zy', '<>', session('major'));
			})
			->whereKcxh($inputs['kcxh'])
			->whereNj($inputs['nj'])
			->whereZy($inputs['zy'])
			->whereGldw(Auth::user()->profile->gldw);

		if ($course->doesntExist()) {
			return redirect('selcourse/search')->withStatus('未找到课程序号，请重新申请！本年级本专业课程请直接在选课管理菜单选课！');
		}

		// 2017-01-02：应教务处要求添加同课程号课程申请检测
		// 2020-01-07：应教务处要求添加检测审核状态
		$sameCourse = Application::whereNd(session('year'))
			->whereXq(session('term'))
			->whereXh(Auth::user()->xh)
			->where('kcxh', 'like', '%' . Helper::getCno($inputs['kcxh']) . '%');
		$appSelectUnaudit = clone $sameCourse;

		$appSelectUnaudit = $appSelectUnaudit->whereNull('tkid');
		$appSelectAudit = clone $appSelectUnaudit;
		if ($appSelectUnaudit->whereSh(0)->exists()) {
			return back()->withInput()->withStatus('同号课程申请未审核，请联系开课学院教学秘书');
		}

		$selectedApp = $appSelectAudit->whereSh(1)->orderBy('xksj', 'desc')->first();
		if ($selectedApp) {
			$appDelete = clone $sameCourse;
			$appDelete = $appDelete->whereNotNull('tkid')->where('xksj', '>=', $selectedApp->xksj);

			if ($appDelete->doesntExist()) {
				return back()->withInput()->withStatus('同号课程申请审核已通过，请不要重复申请');
			}

			if ($appDelete->whereSh(1)->doesntExist()) {
				return back()->withInput()->withStatus('同号课程申请退课未审核或审核未通过，请联系开课学院教学秘书');
			}
		}

		if ('retake' == $inputs['type']) {
			$kch = Helper::getCno($inputs['kcxh']);

			$courses = Selcourse::selected(Auth::user(), $kch)
				->orderBy('sj')
				->get();

			if (!count($courses)) {
				$courses = Selcourse::studied(Auth::user())
					->orderBy('sj', 'desc')
					->get();
			} else {
				$courses = $courses->take(1);
			}
		} else {
			// 2019-11-14：应教务处要求添加申请其他课程修读时不允许申请重修课
			$kch = Helper::getCno($inputs['kcxh']);

			$exists = Selcourse::selected(Auth::user(), $kch)->exists();

			if ($exists) {
				return back()->withInput()->withStatus('该课程属重修课，请在重修课申请中重新申请');
			}
		}

		$view = view('application.create')
			->withTitle('其他课程选课申请表')
			->withType($inputs['type'])
			->withKcxh($inputs['kcxh'])
			->withNj($inputs['nj'])
			->withZy($inputs['zy'])
			->withKkxy($course->first()->kkxy);

		if ('retake' == $inputs['type']) {
			$view = $view->withTitle('重修课程选课申请表')
				->withCourses($courses);
		}

		return $view;
	}

	/**
	 * 保存学生课程申请信息
	 * 2021-06-24：应教务处要求，添加限定学历本科生选课限制功能，即限定管理单位（gldw）
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 申请请求
	 * @return \Illuminate\Http\Response 选课申请列表
	 */
	public function store(Request $request)
	{
		if ($request->isMethod('post')) {
			if ($request->has('tkid')) {
				$tkid = $request->input('tkid');
				$application = Application::findOrFail($tkid)->replicate();
				$application->tkid = $tkid;
				$application->sh   = '0';
				$application->xksj = Carbon::now();
				$application->id   = date('YmdHis') . random_int(1000, 9999);
			} else {
				$this->validate($request, [
					'type' => 'required',
					'kcxh' => 'required|size:12',
				]);

				$inputs = $request->all();

				// 2018-02-09：应教务处要求，在选课申请中排除本年级本专业本学期课程
				// 2021-06-24：应教务处要求，添加限定学历本科生选课限制功能，即限定管理单位（gldw）
				$courses = Mjcourse::whereNd(session('year'))
					->whereXq(session('term'))
					->whereZsjj(session('season'))
					->exceptGeneral()
					->where(function ($query) {
						$query->where('pk_kczy.nj', '<>', session('grade'))
							->orWhere('pk_kczy.zy', '<>', session('major'));
					})
					->whereKcxh($inputs['kcxh'])
					->whereGldw(Auth::user()->profile->gldw);

				if (!$courses->exists()) {
					return redirect('selcourse/search')->withStatus('未找到课程序号，请重新申请！本年级本专业课程请直接在选课管理菜单选课！');
				}

				$course = Mjcourse::whereNd(session('year'))
					->whereXq(session('term'))
					->whereKcxh($inputs['kcxh'])
					->whereZsjj(session('season'))
					->whereZy($inputs['zy'])
					->whereNj($inputs['nj'])
					->whereGldw(Auth::user()->profile->gldw)
					->firstOrFail();
				/*
				$same = Selcourse::whereXh(Auth::user()->xh)
					->whereNd(session('year'))
					->whereXq(session('term'))
					->whereKch(Helper::getCno($course->kcxh))
					->exists();

				if ($same) {
					return back()->withInput()->withStatus('已申请同号课程，请重新申请');
				}
				*/

				// 2017-01-02：应教务处要求添加同课程号课程申请检测
				// 2020-01-07：应教务处要求添加检测审核状态
				$sameCourse = Application::whereNd(session('year'))
					->whereXq(session('term'))
					->whereXh(Auth::user()->xh)
					->where('kcxh', 'like', '%' . Helper::getCno($inputs['kcxh']) . '%');
				$appSelectUnaudit = clone $sameCourse;

				$appSelectUnaudit = $appSelectUnaudit->whereNull('tkid');
				$appSelectAudit = clone $appSelectUnaudit;
				if ($appSelectUnaudit->whereSh(0)->exists()) {
					return redirect('application')->withInput()->withStatus('同号课程申请未审核，请联系开课学院教学秘书');
				}

				$selectedApp = $appSelectAudit->whereSh(1)->orderBy('xksj', 'desc')->first();
				if ($selectedApp) {
					$appDelete = clone $sameCourse;
					$appDelete = $appDelete->whereNotNull('tkid')->where('xksj', '>=', $selectedApp->xksj);

					if ($appDelete->doesntExist()) {
						return redirect('application')->withInput()->withStatus('同号课程申请审核已通过，请不要重复申请');
					}

					if ($appDelete->whereSh(1)->doesntExist()) {
						return redirect('application')->withInput()->withStatus('同号课程申请退课未审核或审核未通过，请联系开课学院教学秘书');
					}
				}

				// 2019-11-14：应教务处要求添加申请其他课程修读时不允许申请重修课
				if ('other' == $inputs['type']) {
					$exists = Selcourse::selected(Auth::user(), Helper::getCno($inputs['kcxh']))->exists();

					if ($exists) {
						return redirect('application')->withInput()->withStatus('该课程属重修课，请在重修课申请中重新申请');
					}
				}

				$application       = new Application;
				$application->xh   = Auth::user()->xh;
				$application->xm   = Auth::user()->profile->xm;
				$application->nd   = $course->nd;
				$application->xq   = $course->xq;
				$application->kcxh = $course->kcxh;
				$application->kch  = Helper::getCno($course->kcxh);
				$application->pt   = $course->pt;
				$application->xz   = $course->xz;
				$application->kkxy = $course->kkxy;
				$application->xf   = $course->plan->zxf;
				$application->sf   = '0';
				$application->sh   = '0';
				$application->xksj = Carbon::now();
				// 2021-01-05：应教务处要求添加申请退课功能，需要增加申请单号
				$application->id   = date('YmdHis') . random_int(1000, 9999);
				$application->kcmc = Helper::getCourseName($course->kcxh);
				$application->zy = $course->zy;
				$application->nj = $course->nj;
				// 2021-06-24：应教务处要求，添加管理单位管理留学生
				$application->gldw = $course->gldw;

				switch ($inputs['type']) {
					case 'other':
						$application->xklx = '0';
						break;

					case 'retake':
						$application->xklx  = '1';
						$application->ynd   = $inputs['ynd'];
						$application->yxq   = $inputs['yxq'];
						$application->ykcxh = $inputs['ykcxh'];
						$application->yxf   = $inputs['yxf'];
						$application->ykcmc = Helper::getCourseName($inputs['ykcxh']);
						break;

					default:
						$application->xklx = '0';
						break;
				}
			}

			if ($application->save()) {
				return redirect('application')->withStatus('课程申请成功');
			} else {
				return back()->withInput()->withStatus('课程申请提交失败');
			}
		}
	}

	/**
	 * 撤销选课申请
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 撤销请求
	 * @param   string $id 18位申请单号
	 * @return  \Illuminate\Http\Response 选课申请列表
	 */
	public function destroy($id)
	{
		/*
		$app = Application::whereXh(Auth::user()->xh)
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereKcxh($kcxh)
			->whereXklx(request('xklx'))
			->whereSh(request('sh'))
			->firstOrFail();
		*/
		$app = Application::findOrFail($id);
		$app->delete();

		return back()->withStatus('撤销课程申请成功');
	}

	/**
	 * 同课程号课程已选检测
	 * @author FuRongxin
	 * @date    2017-05-16
	 * @version 2.1.5
	 * @param  STRING  $kch 8位课程号
	 * @return boolean      true为已选课程，false为未选课程
	 */
	public function isSelected($kch)
	{
		$courses = Selcourse::selected(Auth::user(), $kch)
			->orderBy('sj')
			->get();

		if (request()->ajax()) {
			return response()->json(count($courses));
		} else {
			return count($courses);
		}
	}
}
