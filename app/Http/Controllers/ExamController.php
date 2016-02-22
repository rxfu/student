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
		$profile = Profile::find(Auth::user()->xh);
		$exam    = Extype::find($kslx);

		return view('exam.register')
			->withTitle('考试报名')
			->withInfo('请认真核准自己的报名信息')
			->withProfile($profile)
			->withExam($exam);
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
