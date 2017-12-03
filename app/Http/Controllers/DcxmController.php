<?php

namespace App\Http\Controllers;

use App\Models\Dcxmlb;
use App\Models\Dcxmxx;
use App\Models\Dcyjxk;
use App\Models\Profile;
use App\Models\Teacher;
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
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'xmmc' => 'required|string|max:100',
				'kssj' => 'required|date',
				'jssj' => 'required|date',
			]);
			$inputs = $request->all();

			$xmxx          = new Dcxmxx;
			$xmxx->xmmc    = $inputs['xmmc'];
			$xmxx->xmlb_dm = $inputs['xmlb_dm'];
			$xmxx->yjxk_dm = $inputs['yjxk_dm'];
			$xmxx->xh      = Auth::user()->xh;
			$xmxx->kssj    = $inputs['kssj'];
			$xmxx->jssj    = $inputs['jssj'];
			$xmxx->sfsh    = config('constants.status.disable');
			$xmxx->sftg    = config('constatns.status.disable');
			$xmxx->cjsj    = date('Y-m-d');

			if ($xmxx->save()) {
				return redirect('dcxm/list')->withStatus('项目基本信息保存成功');
			} else {
				return back()->withInput()->withStatus('项目基本信息保存失败');
			}
		}
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

	/**
	 * 获取项目成员信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 项目成员获取请求
	 * @return  \Illuminate\Http\Response 项目成员信息
	 */
	public function getStudent(Request $request) {
		if ($request->isMethod('get')) {
			$exists = Profile::whereXh($request->input('xh'))->exists();

			$student = [
				'xh'   => '',
				'xm'   => '',
				'nj'   => '',
				'szyx' => '',
				'lxdh' => '',
			];
			if ($exists) {
				$profile = Profile::find($request->input('xh'));

				$student['xh']   = $profile->xh;
				$student['xm']   = $profile->xm;
				$student['nj']   = $profile->nj;
				$student['szyx'] = $profile->college->mc;
				$student['lxdh'] = $profile->lxdh;
			} else {
				$student['xm'] = '查无此人';
			}

			return json_encode($student);
		}
	}

	/**
	 * 获取指导教师信息
	 *
	 * @author FuRongxin
	 * @date    2017-12-03
	 * @version 2.3
	 * @param   \Illuminate\Http\Request $request 指导教师获取请求
	 * @return  \Illuminate\Http\Response 指导教师信息
	 */
	public function getTeacher(Request $request) {
		if ($request->isMethod('get')) {
			$exists = Teacher::whereJsgh($request->input('jsgh'))->exists();

			$teacher = [
				'jsgh'  => '',
				'xm'    => '',
				'zc'    => '',
				'szdw'  => '',
				'lxdh'  => '',
				'email' => '',
			];
			if ($exists) {
				$profile = Teacher::find($request->input('jsgh'));

				$teacher['jsgh']  = $profile->jsgh;
				$teacher['xm']    = $profile->xm;
				$teacher['zc']    = $profile->position->mc;
				$teacher['szdw']  = $profile->department->mc;
				$teacher['lxdh']  = $profile->lxdh;
				$teacher['email'] = $profile->email;
			} else {
				$teacher['xm'] = '查无此人';
			}

			return json_encode($teacher);
		}
	}
}
