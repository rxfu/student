<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Exregister;
use App\Models\Exscore;
use App\Models\Extype;
use App\Models\Profile;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 显示并处理国家考试信息
 *
 * @author FuRongxin
 * @date 2016-02-21
 * @version 2.0
 */
class ExamController extends Controller {

	/**
	 * 显示考试列表
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 考试列表
	 */
	public function index() {
		$types = Extype::whereZt(config('constants.status.enable'))->get();

		foreach ($types as $type) {

			// 检测是否CET4
			if (in_array($type->kslx, Helper::getCet4())) {

				// 检测是否允许新生报考CET4
				if (config('constants.status.enable') == Setting::find('KS_CET4_XS')) {

					// 不允许新生报考CET4
					if (Profile::isFresh(Auth::user())->exists()) {
						continue;
					}

				}
			}

			// 检测是否CET6
			if (config('constants.exam.type.cet6') == $type->kslx) {

				// 检测是否允许新生报考CET6
				if (config('constants.status.enable') == Setting::find('KS_CET6_XS')) {

					// 不允许新生报考CET6
					if (Profile::isFresh(Auth::user())->exists()) {
						continue;
					}
				}

				// 检测CET6是否具有过往成绩或者CET4是否及格
				if (!Exscore::whereC_xh(Auth::user()->xh)->whereC_kslx(config('constants.exam.type.cet6'))->exists() && !Exscore::isPassed(Auth::user(), Helper::getCet4())->exists()) {
					continue;
				}
			}

			$exams[] = $type;
		}

		return view('exam.index')->withTitle('考试报名')->withExams($exams);
	}

	/**
	 * 显示考试历次报名信息
	 * @author FuRongxin
	 * @date    2016-02-21
	 * @version 2.0
	 * @return  \Illuminate\Http\Response 历次报名信息列表
	 */
	public function history() {
		$exams = Exregister::whereXh(Auth::user()->xh)
			->orderBy('bmsj', 'desc')
			->get();

		return view('exam.history')->withTitle('历次考试报名信息')->withExams($exams);
	}

	/**
	 * 显示学生报名表
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   string $kslx 考试类型代码
	 * @return  \Illuminate\Http\Response 考试报名表单
	 */
	public function register($kslx) {
		$profile = Profile::find(Auth::user()->xh);
		$exam    = Extype::find($kslx);

		return view('exam.register')
			->withTitle('考试报名')
			->withProfile($profile)
			->withExam($exam);
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
	 * 显示学生报名表
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   string $kslx 考试类型代码
	 * @return  \Illuminate\Http\Response 考试报名表单
	 */
	public function edit($kslx) {
		if (!Storage::exists(config('constants.file.path.portrait') . Auth::user()->profile->sfzh . '.' . config('constants.file.image.ext'))) {
			return redirect('profile/upfile');
		}

		$exam       = Extype::find($kslx);
		$registered = Exregister::whereNd($exam->nd)
			->whereXh(Auth::user()->xh)
			->whereKslx($kslx)
			->exists();

		// 检测是否已经报过CET考试
		if (config('constants.exam.type.cet') == $exam->ksdl) {

			$exams = Exregister::with('type')
				->whereNd($exam->nd)
				->whereXh(Auth::user()->xh);

			foreach ($exams as $cet) {
				if (config('constants.exam.type.cet') == $cet->type->ksdl) {
					abort(403, '已经报名本次' . $cet . '考试，' . $cet . '和' . $exam->ksmc . '不能同时报名');
				}
			}
		}

		$profile = Profile::find(Auth::user()->xh);
		$exam    = Extype::find($kslx);

		return view('exam.register')
			->withTitle('考试报名')
			->withInfo('请认真核准自己的报名信息')
			->withProfile($profile)
			->withExam($exam)
			->withRegistered($registered);
	}

	/**
	 * 学生考试报名
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   \Illuminate\Http\Request $request 报名请求
	 * @param   string $kslx 考试类型代码
	 * @return  \Illuminate\Http\Response 报名列表
	 */
	public function update(Request $request, $kslx) {
		$exam       = Extype::find($kslx);
		$registered = Exregister::whereNd($exam->nd)
			->whereXh(Auth::user()->xh)
			->whereKslx($kslx)
			->exists();

		// 检测是否已经报过名
		if (!$registered) {

			// 检测是否CET4
			if (in_array($exam->kslx, Helper::getCet4())) {

				// 检测是否允许新生报考CET4
				if (config('constants.status.enable') == Setting::find('KS_CET4_XS')) {

					// 不允许新生报考CET4
					if (Profile::isFresh(Auth::user())->exists()) {
						abort(403, '不允许新生报考CET4');
					}

				}
			}

			// 检测是否CET6
			if (config('constants.exam.type.cet6') == $exam->kslx) {

				// 检测是否允许新生报考CET6
				if (config('constants.status.enable') == Setting::find('KS_CET6_XS')) {

					// 不允许新生报考CET6
					if (Profile::isFresh(Auth::user())->exists()) {
						abort(403, '不允许新生报考CET6');
					}
				}

				// 检测CET6是否具有过往成绩或者CET4是否及格
				if (!Exscore::whereC_xh(Auth::user()->xh)->whereC_kslx(config('constants.exam.type.cet6'))->exists() && !Exscore::isPassed(Auth::user(), Helper::getCet4())->exists()) {
					abort(403, '四级成绩不达标，不能参加CET6考试');
				}
			}

			// 检测是否已经报过CET考试
			if (config('constants.exam.type.cet') == $exam->ksdl) {

				$registered = Exregister::with('type')
					->whereNd($exam->nd)
					->whereXh(Auth::user()->xh);

				foreach ($registered as $cet) {
					if (config('constants.exam.type.cet') == $cet->type->ksdl) {
						abort(403, '已经报名本次' . $cet . '考试，' . $cet . '和' . $exam->ksmc . '不能同时报名');
					}
				}
			}
		}

		$register       = new Exregister();
		$register->xh   = Auth::user()->xh;
		$register->xq   = Auth::user()->profile->college->pivot->xq;
		$register->kslx = $kslx;
		$register->bklb = '00';
		$register->kssj = $exam->sj;
		$register->clbz = config('constants.exam.status.register');
		$register->bmsj = date('Y-m-d H:i:s');
		$register->nd   = $exam->nd;
		$register->save();

		return redirect('exam')->withStatus('考试报名成功');
	}

	/**
	 * 取消学生考试报名
	 * @author FuRongxin
	 * @date    2016-02-22
	 * @version 2.0
	 * @param   string $kslx 考试类型代码
	 * @return  \Illuminate\Http\Response 报名列表
	 */
	public function destroy($kslx) {
		$exam = Extype::find($kslx);

		if (!empty($exam)) {
			$deleteRows = Exregister::whereXh(Auth::user()->xh)
				->whereKslx($kslx)
				->whereKssj($exam->sj)
				->first()
				->delete();

			return redirect('exam')->withStatus('取消报名成功');
		}
	}
}
