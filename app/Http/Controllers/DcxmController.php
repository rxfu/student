<?php

namespace App\Http\Controllers;

use App\Models\Dcxmlb;
use App\Models\Dcxmxx;
use App\Models\Dcyjxk;
use Auth;
use Illuminate\Http\Request;

/**
 * 显示并处理大创项目西悉尼
 *
 * @author FuRongxin
 * @date 2017-11-22
 * @version 2.3
 */
class DcxmController extends Controller {

	/**
	 * 显示大创项目列表
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function getList() {
		$projects = Dcxmxx::whereXh(Auth::user()->xh)
			->orderBy('cjsj', 'desc')
			->get();
		$title = '项目申请列表';

		return view('dcxm.list', compact('title', 'projects'));
	}

	/**
	 * 大创项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function getInfo() {
		$categories = Dcxmlb::orderBy('dm')->get();
		$subjects   = Dcyjxk::orderBy('dm')->get();
		$title      = '项目申请';

		return view('dcxm.information', compact('title', 'categories', 'subjects'));
	}

	/**
	 * 保存大创项目基本信息
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目信息请求
	 * @return  \Illuminate\Http\Response 大创项目基本信息
	 */
	public function postInfo(Request $request) {

	}

	/**
	 * 大创项目申请
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function getApplication() {
		$title = '项目申报书';

		return view('dcxm.application', compact('title', 'categories', 'subjects'));
	}

	/**
	 * 大创项目申请
	 *
	 * @author FuRongxin
	 * @date    2017-11-22
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目申请请求
	 * @return  \Illuminate\Http\Response 大创项目列表
	 */
	public function postApplication(Request $request) {
		return redirect('dcxm/list');
	}
}
