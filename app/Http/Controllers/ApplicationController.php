<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Application;
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
		$apps = Application::whereXh(Auth::user()->xh)
			->orderBy('xksj', 'desc')
			->get();

		return view('application.index')->withTitle('课程申请进度')->withApps($apps);
	}

	/**
	 * 显示学生选课申请表单
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param  \Illuminate\Http\Request  $request 申请请求
	 * @return  \Illuminate\Http\Response 选课申请表单
	 */
	public function create(Request $request) {
		$inputs = $request->all();

		return view('application.create')
			->withTitle('选课申请表')
			->withType($inputs['type'])
			->withKcxh($inputs['kcxh']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'type' => 'require',
				'kcxh' => 'require|size:12',
			]);

			$course = Mjcourse::whereNd(session('year'))
				->whereXq(sesion('term'))
				->whereKcxh($inputs['kcxh'])
				->whereZsjj(session('season'))
				->whereNj(session('grade'))
				->whereZy(session('major'))
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
			$application->xf   = $course->plan->xf;
			$application->sf   = '0';
			$application->sh   = '0';
			$application->xksj = Carbon::now();

			switch ($inputs['type']) {
			case 'other':
				$application->xklx = '0';
				break;
			case 'retake':
				$application->xklx = '1';
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
	/**
	 * 撤销选课申请
	 * @author FuRongxin
	 * @date    2016-02-23
	 * @version 2.0
	 * @param   string $kcxh 12位课程序号
	 * @return  \Illuminate\Http\Response 选课申请列表
	 */
	public function destroy($kcxh) {
		$app = Application::whereXh(Auth::user()->xh)
			->whereNd(session('year'))
			->whereXq(session('term'))
			->whereKcxh($kcxh)
			->firstOrFail();

		$app->delete();

		return back()->withStatus('撤销课程申请成功');
	}
}
