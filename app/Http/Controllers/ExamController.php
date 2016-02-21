<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\Exregister;
use App\Models\Extype;
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
					$is_fresh = Student::whereXh(Auth::user()->xh)
						->whereXjzt(config('constants.student.school'))
						->whereRaw('age(rxrq) < \'1 year\'')
						->exists();
				}
			}
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
