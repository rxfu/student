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
class ApplicationController extends Controller {

	/**
	 * 选课申请进度查询
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 选课申请进度列表
	 */
	public function index() {
		$apps = Application::with('term')
			->whereXh(Auth::user()->xh)
			->orderBy('xksj', 'desc')
			->get();

		return view('application.index')->withTitle('课程申请进度')->withApps($apps);
	}

	/**
	 * 显示学生选课申请表单
	 * 2017-01-02：应教务处要求，添加同课程号课程申请检测
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 申请请求
	 * @return  \Illuminate\Http\Response 选课申请表单
	 */
	public function create(Request $request) {
		$inputs = $request->all();

		// 2017-01-02：应教务处要求添加同课程号课程申请检测
		$exists = Application::whereNd(session('year'))
			->whereXq(session('term'))
			->whereXh(Auth::user()->xh)
			->where('kcxh', 'like', '%' . Helper::getCno($inputs['kcxh']) . '%')
			->exists();

		if ($exists) {
			return back()->withInput()->withStatus('已选同号课程，请重新申请');
		}

		if ('retake' == $inputs['type']) {
			$courses = Selcourse::studied(Auth::user())
				->orderBy('sj', 'desc')
				->get();
		}

		$view = view('application.create')
			->withTitle('其他课程选课申请表')
			->withType($inputs['type'])
			->withKcxh($inputs['kcxh']);

		if ('retake' == $inputs['type']) {
			$view = $view->withTitle('重修课程选课申请表')
				->withCourses($courses);
		}

		return $view;
	}

	/**
	 * 保存学生选课申请信息
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 申请请求
	 * @return \Illuminate\Http\Response 选课申请列表
	 */
	public function store(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'type' => 'required',
				'kcxh' => 'required|size:12',
			]);

			$inputs = $request->all();

			$course = Mjcourse::whereNd(session('year'))
				->whereXq(session('term'))
				->whereKcxh($inputs['kcxh'])
				->whereZsjj(session('season'))
				->firstOrFail();

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
				break;

			default:
				$application->xklx = '0';
				break;
			}

			if ($application->save()) {
				return redirect('application')->withStatus('课程申请成功');
			} else {
				return back()->withInput()->withStatus('选课申请提交失败');
			}
		}
	}

	/**
	 * 撤销选课申请
	 * @author FuRongxin
	 * @date    2017-01-02
	 * @version 2.1.3
	 * @param  \Illuminate\Http\Request  $request 撤销请求
	 * @param   string $kcxh 12位课程序号
	 * @return  \Illuminate\Http\Response 选课申请列表
	 */
	public function destroy($kcxh) {
		$app = Application::whereXh(Auth::user()->xh)
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereKcxh($kcxh)
			->whereXklx(request('xklx'))
			->whereSh(request('sh'))
			->firstOrFail();

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
	public function isSelected($kch) {
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
